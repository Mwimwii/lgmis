<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class receipt_add extends receipt
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'receipt';

	// Page object name
	public $PageObjName = "receipt_add";

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (receipt)
		if (!isset($GLOBALS["receipt"]) || get_class($GLOBALS["receipt"]) == PROJECT_NAMESPACE . "receipt") {
			$GLOBALS["receipt"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["receipt"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (receipt_header)
		if (!isset($GLOBALS['receipt_header']))
			$GLOBALS['receipt_header'] = new receipt_header();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'receipt');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (musers)
		$UserTable = $UserTable ?: new musers();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $receipt;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($receipt);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "receiptview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['ClientSerNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ChargeCode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ItemID'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ReceiptNo'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (IsPasswordExpired())
				$this->terminate(GetUrl("changepwd.php"));
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("receiptlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ClientSerNo->setVisibility();
		$this->ChargeCode->setVisibility();
		$this->ItemID->setVisibility();
		$this->UnitCost->setVisibility();
		$this->Quantity->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->AmountPaid->setVisibility();
		$this->ReceiptNo->setVisibility();
		$this->ReceiptDate->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->PaymentRef->setVisibility();
		$this->AdditionalInformation->Visible = FALSE;
		$this->LastUpdatedBy->Visible = FALSE;
		$this->LastUpdateDate->Visible = FALSE;
		$this->CashierNo->setVisibility();
		$this->BillPeriod->setVisibility();
		$this->BillYear->setVisibility();
		$this->PaymentFor->Visible = FALSE;
		$this->ChargeGroup->setVisibility();
		$this->ClientID->setVisibility();
		$this->PrintedReceipt->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->ClientSerNo);
		$this->setupLookupOptions($this->ChargeCode);
		$this->setupLookupOptions($this->PaymentMethod);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("receiptlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("ClientSerNo") !== NULL) {
				$this->ClientSerNo->setQueryStringValue(Get("ClientSerNo"));
				$this->setKey("ClientSerNo", $this->ClientSerNo->CurrentValue); // Set up key
			} else {
				$this->setKey("ClientSerNo", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("ChargeCode") !== NULL) {
				$this->ChargeCode->setQueryStringValue(Get("ChargeCode"));
				$this->setKey("ChargeCode", $this->ChargeCode->CurrentValue); // Set up key
			} else {
				$this->setKey("ChargeCode", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("ItemID") !== NULL) {
				$this->ItemID->setQueryStringValue(Get("ItemID"));
				$this->setKey("ItemID", $this->ItemID->CurrentValue); // Set up key
			} else {
				$this->setKey("ItemID", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("ReceiptNo") !== NULL) {
				$this->ReceiptNo->setQueryStringValue(Get("ReceiptNo"));
				$this->setKey("ReceiptNo", $this->ReceiptNo->CurrentValue); // Set up key
			} else {
				$this->setKey("ReceiptNo", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("receiptlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "receiptlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "receiptview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ClientSerNo->CurrentValue = NULL;
		$this->ClientSerNo->OldValue = $this->ClientSerNo->CurrentValue;
		$this->ChargeCode->CurrentValue = NULL;
		$this->ChargeCode->OldValue = $this->ChargeCode->CurrentValue;
		$this->ItemID->CurrentValue = NULL;
		$this->ItemID->OldValue = $this->ItemID->CurrentValue;
		$this->UnitCost->CurrentValue = NULL;
		$this->UnitCost->OldValue = $this->UnitCost->CurrentValue;
		$this->Quantity->CurrentValue = 1;
		$this->UnitOfMeasure->CurrentValue = "Each";
		$this->AmountPaid->CurrentValue = NULL;
		$this->AmountPaid->OldValue = $this->AmountPaid->CurrentValue;
		$this->ReceiptNo->CurrentValue = NULL;
		$this->ReceiptNo->OldValue = $this->ReceiptNo->CurrentValue;
		$this->ReceiptDate->CurrentValue = NULL;
		$this->ReceiptDate->OldValue = $this->ReceiptDate->CurrentValue;
		$this->PaymentMethod->CurrentValue = NULL;
		$this->PaymentMethod->OldValue = $this->PaymentMethod->CurrentValue;
		$this->PaymentRef->CurrentValue = NULL;
		$this->PaymentRef->OldValue = $this->PaymentRef->CurrentValue;
		$this->AdditionalInformation->CurrentValue = NULL;
		$this->AdditionalInformation->OldValue = $this->AdditionalInformation->CurrentValue;
		$this->LastUpdatedBy->CurrentValue = NULL;
		$this->LastUpdatedBy->OldValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdateDate->CurrentValue = NULL;
		$this->LastUpdateDate->OldValue = $this->LastUpdateDate->CurrentValue;
		$this->CashierNo->CurrentValue = NULL;
		$this->CashierNo->OldValue = $this->CashierNo->CurrentValue;
		$this->BillPeriod->CurrentValue = NULL;
		$this->BillPeriod->OldValue = $this->BillPeriod->CurrentValue;
		$this->BillYear->CurrentValue = NULL;
		$this->BillYear->OldValue = $this->BillYear->CurrentValue;
		$this->PaymentFor->CurrentValue = NULL;
		$this->PaymentFor->OldValue = $this->PaymentFor->CurrentValue;
		$this->ChargeGroup->CurrentValue = NULL;
		$this->ChargeGroup->OldValue = $this->ChargeGroup->CurrentValue;
		$this->ClientID->CurrentValue = NULL;
		$this->ClientID->OldValue = $this->ClientID->CurrentValue;
		$this->PrintedReceipt->CurrentValue = NULL;
		$this->PrintedReceipt->OldValue = $this->PrintedReceipt->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ClientSerNo' first before field var 'x_ClientSerNo'
		$val = $CurrentForm->hasValue("ClientSerNo") ? $CurrentForm->getValue("ClientSerNo") : $CurrentForm->getValue("x_ClientSerNo");
		if (!$this->ClientSerNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientSerNo->Visible = FALSE; // Disable update for API request
			else
				$this->ClientSerNo->setFormValue($val);
		}

		// Check field name 'ChargeCode' first before field var 'x_ChargeCode'
		$val = $CurrentForm->hasValue("ChargeCode") ? $CurrentForm->getValue("ChargeCode") : $CurrentForm->getValue("x_ChargeCode");
		if (!$this->ChargeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeCode->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeCode->setFormValue($val);
		}

		// Check field name 'ItemID' first before field var 'x_ItemID'
		$val = $CurrentForm->hasValue("ItemID") ? $CurrentForm->getValue("ItemID") : $CurrentForm->getValue("x_ItemID");
		if (!$this->ItemID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ItemID->Visible = FALSE; // Disable update for API request
			else
				$this->ItemID->setFormValue($val);
		}

		// Check field name 'UnitCost' first before field var 'x_UnitCost'
		$val = $CurrentForm->hasValue("UnitCost") ? $CurrentForm->getValue("UnitCost") : $CurrentForm->getValue("x_UnitCost");
		if (!$this->UnitCost->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitCost->Visible = FALSE; // Disable update for API request
			else
				$this->UnitCost->setFormValue($val);
		}

		// Check field name 'Quantity' first before field var 'x_Quantity'
		$val = $CurrentForm->hasValue("Quantity") ? $CurrentForm->getValue("Quantity") : $CurrentForm->getValue("x_Quantity");
		if (!$this->Quantity->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Quantity->Visible = FALSE; // Disable update for API request
			else
				$this->Quantity->setFormValue($val);
		}

		// Check field name 'UnitOfMeasure' first before field var 'x_UnitOfMeasure'
		$val = $CurrentForm->hasValue("UnitOfMeasure") ? $CurrentForm->getValue("UnitOfMeasure") : $CurrentForm->getValue("x_UnitOfMeasure");
		if (!$this->UnitOfMeasure->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitOfMeasure->Visible = FALSE; // Disable update for API request
			else
				$this->UnitOfMeasure->setFormValue($val);
		}

		// Check field name 'AmountPaid' first before field var 'x_AmountPaid'
		$val = $CurrentForm->hasValue("AmountPaid") ? $CurrentForm->getValue("AmountPaid") : $CurrentForm->getValue("x_AmountPaid");
		if (!$this->AmountPaid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPaid->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPaid->setFormValue($val);
		}

		// Check field name 'ReceiptNo' first before field var 'x_ReceiptNo'
		$val = $CurrentForm->hasValue("ReceiptNo") ? $CurrentForm->getValue("ReceiptNo") : $CurrentForm->getValue("x_ReceiptNo");
		if (!$this->ReceiptNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptNo->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptNo->setFormValue($val);
		}

		// Check field name 'ReceiptDate' first before field var 'x_ReceiptDate'
		$val = $CurrentForm->hasValue("ReceiptDate") ? $CurrentForm->getValue("ReceiptDate") : $CurrentForm->getValue("x_ReceiptDate");
		if (!$this->ReceiptDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptDate->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptDate->setFormValue($val);
			$this->ReceiptDate->CurrentValue = UnFormatDateTime($this->ReceiptDate->CurrentValue, 7);
		}

		// Check field name 'PaymentMethod' first before field var 'x_PaymentMethod'
		$val = $CurrentForm->hasValue("PaymentMethod") ? $CurrentForm->getValue("PaymentMethod") : $CurrentForm->getValue("x_PaymentMethod");
		if (!$this->PaymentMethod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentMethod->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentMethod->setFormValue($val);
		}

		// Check field name 'PaymentRef' first before field var 'x_PaymentRef'
		$val = $CurrentForm->hasValue("PaymentRef") ? $CurrentForm->getValue("PaymentRef") : $CurrentForm->getValue("x_PaymentRef");
		if (!$this->PaymentRef->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentRef->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentRef->setFormValue($val);
		}

		// Check field name 'CashierNo' first before field var 'x_CashierNo'
		$val = $CurrentForm->hasValue("CashierNo") ? $CurrentForm->getValue("CashierNo") : $CurrentForm->getValue("x_CashierNo");
		if (!$this->CashierNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CashierNo->Visible = FALSE; // Disable update for API request
			else
				$this->CashierNo->setFormValue($val);
		}

		// Check field name 'BillPeriod' first before field var 'x_BillPeriod'
		$val = $CurrentForm->hasValue("BillPeriod") ? $CurrentForm->getValue("BillPeriod") : $CurrentForm->getValue("x_BillPeriod");
		if (!$this->BillPeriod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillPeriod->Visible = FALSE; // Disable update for API request
			else
				$this->BillPeriod->setFormValue($val);
		}

		// Check field name 'BillYear' first before field var 'x_BillYear'
		$val = $CurrentForm->hasValue("BillYear") ? $CurrentForm->getValue("BillYear") : $CurrentForm->getValue("x_BillYear");
		if (!$this->BillYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillYear->Visible = FALSE; // Disable update for API request
			else
				$this->BillYear->setFormValue($val);
		}

		// Check field name 'ChargeGroup' first before field var 'x_ChargeGroup'
		$val = $CurrentForm->hasValue("ChargeGroup") ? $CurrentForm->getValue("ChargeGroup") : $CurrentForm->getValue("x_ChargeGroup");
		if (!$this->ChargeGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGroup->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGroup->setFormValue($val);
		}

		// Check field name 'ClientID' first before field var 'x_ClientID'
		$val = $CurrentForm->hasValue("ClientID") ? $CurrentForm->getValue("ClientID") : $CurrentForm->getValue("x_ClientID");
		if (!$this->ClientID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientID->Visible = FALSE; // Disable update for API request
			else
				$this->ClientID->setFormValue($val);
		}

		// Check field name 'PrintedReceipt' first before field var 'x_PrintedReceipt'
		$val = $CurrentForm->hasValue("PrintedReceipt") ? $CurrentForm->getValue("PrintedReceipt") : $CurrentForm->getValue("x_PrintedReceipt");
		if (!$this->PrintedReceipt->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PrintedReceipt->Visible = FALSE; // Disable update for API request
			else
				$this->PrintedReceipt->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ClientSerNo->CurrentValue = $this->ClientSerNo->FormValue;
		$this->ChargeCode->CurrentValue = $this->ChargeCode->FormValue;
		$this->ItemID->CurrentValue = $this->ItemID->FormValue;
		$this->UnitCost->CurrentValue = $this->UnitCost->FormValue;
		$this->Quantity->CurrentValue = $this->Quantity->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->AmountPaid->CurrentValue = $this->AmountPaid->FormValue;
		$this->ReceiptNo->CurrentValue = $this->ReceiptNo->FormValue;
		$this->ReceiptDate->CurrentValue = $this->ReceiptDate->FormValue;
		$this->ReceiptDate->CurrentValue = UnFormatDateTime($this->ReceiptDate->CurrentValue, 7);
		$this->PaymentMethod->CurrentValue = $this->PaymentMethod->FormValue;
		$this->PaymentRef->CurrentValue = $this->PaymentRef->FormValue;
		$this->CashierNo->CurrentValue = $this->CashierNo->FormValue;
		$this->BillPeriod->CurrentValue = $this->BillPeriod->FormValue;
		$this->BillYear->CurrentValue = $this->BillYear->FormValue;
		$this->ChargeGroup->CurrentValue = $this->ChargeGroup->FormValue;
		$this->ClientID->CurrentValue = $this->ClientID->FormValue;
		$this->PrintedReceipt->CurrentValue = $this->PrintedReceipt->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->ClientSerNo->setDbValue($row['ClientSerNo']);
		$this->ChargeCode->setDbValue($row['ChargeCode']);
		if (array_key_exists('EV__ChargeCode', $rs->fields)) {
			$this->ChargeCode->VirtualValue = $rs->fields('EV__ChargeCode'); // Set up virtual field value
		} else {
			$this->ChargeCode->VirtualValue = ""; // Clear value
		}
		$this->ItemID->setDbValue($row['ItemID']);
		$this->UnitCost->setDbValue($row['UnitCost']);
		$this->Quantity->setDbValue($row['Quantity']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->AmountPaid->setDbValue($row['AmountPaid']);
		$this->ReceiptNo->setDbValue($row['ReceiptNo']);
		$this->ReceiptDate->setDbValue($row['ReceiptDate']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
		$this->PaymentRef->setDbValue($row['PaymentRef']);
		$this->AdditionalInformation->setDbValue($row['AdditionalInformation']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
		$this->CashierNo->setDbValue($row['CashierNo']);
		$this->BillPeriod->setDbValue($row['BillPeriod']);
		$this->BillYear->setDbValue($row['BillYear']);
		$this->PaymentFor->setDbValue($row['PaymentFor']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->PrintedReceipt->setDbValue($row['PrintedReceipt']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ClientSerNo'] = $this->ClientSerNo->CurrentValue;
		$row['ChargeCode'] = $this->ChargeCode->CurrentValue;
		$row['ItemID'] = $this->ItemID->CurrentValue;
		$row['UnitCost'] = $this->UnitCost->CurrentValue;
		$row['Quantity'] = $this->Quantity->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['AmountPaid'] = $this->AmountPaid->CurrentValue;
		$row['ReceiptNo'] = $this->ReceiptNo->CurrentValue;
		$row['ReceiptDate'] = $this->ReceiptDate->CurrentValue;
		$row['PaymentMethod'] = $this->PaymentMethod->CurrentValue;
		$row['PaymentRef'] = $this->PaymentRef->CurrentValue;
		$row['AdditionalInformation'] = $this->AdditionalInformation->CurrentValue;
		$row['LastUpdatedBy'] = $this->LastUpdatedBy->CurrentValue;
		$row['LastUpdateDate'] = $this->LastUpdateDate->CurrentValue;
		$row['CashierNo'] = $this->CashierNo->CurrentValue;
		$row['BillPeriod'] = $this->BillPeriod->CurrentValue;
		$row['BillYear'] = $this->BillYear->CurrentValue;
		$row['PaymentFor'] = $this->PaymentFor->CurrentValue;
		$row['ChargeGroup'] = $this->ChargeGroup->CurrentValue;
		$row['ClientID'] = $this->ClientID->CurrentValue;
		$row['PrintedReceipt'] = $this->PrintedReceipt->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ClientSerNo")) != "")
			$this->ClientSerNo->OldValue = $this->getKey("ClientSerNo"); // ClientSerNo
		else
			$validKey = FALSE;
		if (strval($this->getKey("ChargeCode")) != "")
			$this->ChargeCode->OldValue = $this->getKey("ChargeCode"); // ChargeCode
		else
			$validKey = FALSE;
		if (strval($this->getKey("ItemID")) != "")
			$this->ItemID->OldValue = $this->getKey("ItemID"); // ItemID
		else
			$validKey = FALSE;
		if (strval($this->getKey("ReceiptNo")) != "")
			$this->ReceiptNo->OldValue = $this->getKey("ReceiptNo"); // ReceiptNo
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->UnitCost->FormValue == $this->UnitCost->CurrentValue && is_numeric(ConvertToFloatString($this->UnitCost->CurrentValue)))
			$this->UnitCost->CurrentValue = ConvertToFloatString($this->UnitCost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Quantity->FormValue == $this->Quantity->CurrentValue && is_numeric(ConvertToFloatString($this->Quantity->CurrentValue)))
			$this->Quantity->CurrentValue = ConvertToFloatString($this->Quantity->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountPaid->FormValue == $this->AmountPaid->CurrentValue && is_numeric(ConvertToFloatString($this->AmountPaid->CurrentValue)))
			$this->AmountPaid->CurrentValue = ConvertToFloatString($this->AmountPaid->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ClientSerNo
		// ChargeCode
		// ItemID
		// UnitCost
		// Quantity
		// UnitOfMeasure
		// AmountPaid
		// ReceiptNo
		// ReceiptDate
		// PaymentMethod
		// PaymentRef
		// AdditionalInformation
		// LastUpdatedBy
		// LastUpdateDate
		// CashierNo
		// BillPeriod
		// BillYear
		// PaymentFor
		// ChargeGroup
		// ClientID
		// PrintedReceipt

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ClientSerNo
			$curVal = strval($this->ClientSerNo->CurrentValue);
			if ($curVal != "") {
				$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
				if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
					}
				}
			} else {
				$this->ClientSerNo->ViewValue = NULL;
			}
			$this->ClientSerNo->ViewCustomAttributes = "";

			// ChargeCode
			if ($this->ChargeCode->VirtualValue != "") {
				$this->ChargeCode->ViewValue = $this->ChargeCode->VirtualValue;
			} else {
				$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
				$curVal = strval($this->ChargeCode->CurrentValue);
				if ($curVal != "") {
					$this->ChargeCode->ViewValue = $this->ChargeCode->lookupCacheOption($curVal);
					if ($this->ChargeCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ChargeCode->ViewValue = $this->ChargeCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
						}
					}
				} else {
					$this->ChargeCode->ViewValue = NULL;
				}
			}
			$this->ChargeCode->ViewCustomAttributes = "";

			// ItemID
			$this->ItemID->ViewValue = $this->ItemID->CurrentValue;
			$this->ItemID->ViewCustomAttributes = "";

			// UnitCost
			$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
			$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
			$this->UnitCost->ViewCustomAttributes = "";

			// Quantity
			$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
			$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 2, -2, -2, -2);
			$this->Quantity->ViewCustomAttributes = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
			$this->UnitOfMeasure->ViewCustomAttributes = "";

			// AmountPaid
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
			$this->AmountPaid->CellCssStyle .= "text-align: right;";
			$this->AmountPaid->ViewCustomAttributes = "";

			// ReceiptNo
			$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
			$this->ReceiptNo->ViewCustomAttributes = "";

			// ReceiptDate
			$this->ReceiptDate->ViewValue = $this->ReceiptDate->CurrentValue;
			$this->ReceiptDate->ViewValue = FormatDateTime($this->ReceiptDate->ViewValue, 7);
			$this->ReceiptDate->ViewCustomAttributes = "";

			// PaymentMethod
			$curVal = strval($this->PaymentMethod->CurrentValue);
			if ($curVal != "") {
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
					}
				}
			} else {
				$this->PaymentMethod->ViewValue = NULL;
			}
			$this->PaymentMethod->ViewCustomAttributes = "";

			// PaymentRef
			$this->PaymentRef->ViewValue = $this->PaymentRef->CurrentValue;
			$this->PaymentRef->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// CashierNo
			$this->CashierNo->ViewValue = $this->CashierNo->CurrentValue;
			$this->CashierNo->ViewCustomAttributes = "";

			// BillPeriod
			$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
			$this->BillPeriod->ViewValue = FormatNumber($this->BillPeriod->ViewValue, 0, -2, -2, -2);
			$this->BillPeriod->ViewCustomAttributes = "";

			// BillYear
			$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
			$this->BillYear->ViewCustomAttributes = "";

			// PaymentFor
			$this->PaymentFor->ViewValue = $this->PaymentFor->CurrentValue;
			$this->PaymentFor->ViewCustomAttributes = "";

			// ChargeGroup
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
			$this->ChargeGroup->ViewCustomAttributes = "";

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$this->ClientID->ViewCustomAttributes = "";

			// PrintedReceipt
			$this->PrintedReceipt->ViewValue = $this->PrintedReceipt->CurrentValue;
			$this->PrintedReceipt->ViewCustomAttributes = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";
			$this->ChargeCode->TooltipValue = "";

			// ItemID
			$this->ItemID->LinkCustomAttributes = "";
			$this->ItemID->HrefValue = "";
			$this->ItemID->TooltipValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";
			$this->UnitCost->TooltipValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";
			$this->Quantity->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";
			$this->AmountPaid->TooltipValue = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";
			$this->ReceiptNo->TooltipValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";
			$this->ReceiptDate->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";

			// PaymentRef
			$this->PaymentRef->LinkCustomAttributes = "";
			$this->PaymentRef->HrefValue = "";
			$this->PaymentRef->TooltipValue = "";

			// CashierNo
			$this->CashierNo->LinkCustomAttributes = "";
			$this->CashierNo->HrefValue = "";
			$this->CashierNo->TooltipValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";
			$this->BillPeriod->TooltipValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";
			$this->BillYear->TooltipValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// PrintedReceipt
			$this->PrintedReceipt->LinkCustomAttributes = "";
			$this->PrintedReceipt->HrefValue = "";
			$this->PrintedReceipt->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ClientSerNo
			$this->ClientSerNo->EditCustomAttributes = "";
			if ($this->ClientSerNo->getSessionValue() != "") {
				$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
				$curVal = strval($this->ClientSerNo->CurrentValue);
				if ($curVal != "") {
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
					if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
						}
					}
				} else {
					$this->ClientSerNo->ViewValue = NULL;
				}
				$this->ClientSerNo->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ClientSerNo->CurrentValue));
				if ($curVal != "")
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
				else
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->Lookup !== NULL && is_array($this->ClientSerNo->Lookup->Options) ? $curVal : NULL;
				if ($this->ClientSerNo->ViewValue !== NULL) { // Load from cache
					$this->ClientSerNo->EditValue = array_values($this->ClientSerNo->Lookup->Options);
					if ($this->ClientSerNo->ViewValue == "")
						$this->ClientSerNo->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ClientSerNo`" . SearchString("=", $this->ClientSerNo->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ClientSerNo->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
					} else {
						$this->ClientSerNo->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ClientSerNo->EditValue = $arwrk;
				}
			}

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
			$curVal = strval($this->ChargeCode->CurrentValue);
			if ($curVal != "") {
				$this->ChargeCode->EditValue = $this->ChargeCode->lookupCacheOption($curVal);
				if ($this->ChargeCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ChargeCode->EditValue = $this->ChargeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
					}
				}
			} else {
				$this->ChargeCode->EditValue = NULL;
			}
			$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

			// ItemID
			$this->ItemID->EditAttrs["class"] = "form-control";
			$this->ItemID->EditCustomAttributes = "";
			if (!$this->ItemID->Raw)
				$this->ItemID->CurrentValue = HtmlDecode($this->ItemID->CurrentValue);
			$this->ItemID->EditValue = HtmlEncode($this->ItemID->CurrentValue);
			$this->ItemID->PlaceHolder = RemoveHtml($this->ItemID->caption());

			// UnitCost
			$this->UnitCost->EditAttrs["class"] = "form-control";
			$this->UnitCost->EditCustomAttributes = "";
			$this->UnitCost->EditValue = HtmlEncode($this->UnitCost->CurrentValue);
			$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());
			if (strval($this->UnitCost->EditValue) != "" && is_numeric($this->UnitCost->EditValue))
				$this->UnitCost->EditValue = FormatNumber($this->UnitCost->EditValue, -2, -2, -2, -2);
			

			// Quantity
			$this->Quantity->EditAttrs["class"] = "form-control";
			$this->Quantity->EditCustomAttributes = "";
			$this->Quantity->EditValue = HtmlEncode($this->Quantity->CurrentValue);
			$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());
			if (strval($this->Quantity->EditValue) != "" && is_numeric($this->Quantity->EditValue))
				$this->Quantity->EditValue = FormatNumber($this->Quantity->EditValue, -2, -2, -2, -2);
			

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			if (!$this->UnitOfMeasure->Raw)
				$this->UnitOfMeasure->CurrentValue = HtmlDecode($this->UnitOfMeasure->CurrentValue);
			$this->UnitOfMeasure->EditValue = HtmlEncode($this->UnitOfMeasure->CurrentValue);
			$this->UnitOfMeasure->PlaceHolder = RemoveHtml($this->UnitOfMeasure->caption());

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->CurrentValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -2, -2, -2);
			

			// ReceiptNo
			$this->ReceiptNo->EditAttrs["class"] = "form-control";
			$this->ReceiptNo->EditCustomAttributes = "";
			if ($this->ReceiptNo->getSessionValue() != "") {
				$this->ReceiptNo->CurrentValue = $this->ReceiptNo->getSessionValue();
				$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
				$this->ReceiptNo->ViewCustomAttributes = "";
			} else {
				$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->CurrentValue);
				$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());
			}

			// ReceiptDate
			// PaymentMethod

			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if ($this->PaymentMethod->getSessionValue() != "") {
				$this->PaymentMethod->CurrentValue = $this->PaymentMethod->getSessionValue();
				$curVal = strval($this->PaymentMethod->CurrentValue);
				if ($curVal != "") {
					$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
					if ($this->PaymentMethod->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->PaymentMethod->ViewValue = $this->PaymentMethod->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
						}
					}
				} else {
					$this->PaymentMethod->ViewValue = NULL;
				}
				$this->PaymentMethod->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->PaymentMethod->CurrentValue));
				if ($curVal != "")
					$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
				else
					$this->PaymentMethod->ViewValue = $this->PaymentMethod->Lookup !== NULL && is_array($this->PaymentMethod->Lookup->Options) ? $curVal : NULL;
				if ($this->PaymentMethod->ViewValue !== NULL) { // Load from cache
					$this->PaymentMethod->EditValue = array_values($this->PaymentMethod->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`PaymentMethod`" . SearchString("=", $this->PaymentMethod->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->PaymentMethod->EditValue = $arwrk;
				}
			}

			// PaymentRef
			$this->PaymentRef->EditAttrs["class"] = "form-control";
			$this->PaymentRef->EditCustomAttributes = "";
			if (!$this->PaymentRef->Raw)
				$this->PaymentRef->CurrentValue = HtmlDecode($this->PaymentRef->CurrentValue);
			$this->PaymentRef->EditValue = HtmlEncode($this->PaymentRef->CurrentValue);
			$this->PaymentRef->PlaceHolder = RemoveHtml($this->PaymentRef->caption());

			// CashierNo
			// BillPeriod

			$this->BillPeriod->EditAttrs["class"] = "form-control";
			$this->BillPeriod->EditCustomAttributes = "";
			$this->BillPeriod->EditValue = HtmlEncode($this->BillPeriod->CurrentValue);
			$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());

			// BillYear
			$this->BillYear->EditAttrs["class"] = "form-control";
			$this->BillYear->EditCustomAttributes = "";
			$this->BillYear->EditValue = HtmlEncode($this->BillYear->CurrentValue);
			$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			if ($this->ChargeGroup->getSessionValue() != "") {
				$this->ChargeGroup->CurrentValue = $this->ChargeGroup->getSessionValue();
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
				$this->ChargeGroup->ViewCustomAttributes = "";
			} else {
				if (!$this->ChargeGroup->Raw)
					$this->ChargeGroup->CurrentValue = HtmlDecode($this->ChargeGroup->CurrentValue);
				$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
				$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());
			}

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// PrintedReceipt
			$this->PrintedReceipt->EditAttrs["class"] = "form-control";
			$this->PrintedReceipt->EditCustomAttributes = "";
			$this->PrintedReceipt->EditValue = HtmlEncode($this->PrintedReceipt->CurrentValue);
			$this->PrintedReceipt->PlaceHolder = RemoveHtml($this->PrintedReceipt->caption());

			// Add refer script
			// ClientSerNo

			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";

			// ItemID
			$this->ItemID->LinkCustomAttributes = "";
			$this->ItemID->HrefValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// PaymentRef
			$this->PaymentRef->LinkCustomAttributes = "";
			$this->PaymentRef->HrefValue = "";

			// CashierNo
			$this->CashierNo->LinkCustomAttributes = "";
			$this->CashierNo->HrefValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";

			// PrintedReceipt
			$this->PrintedReceipt->LinkCustomAttributes = "";
			$this->PrintedReceipt->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->ClientSerNo->Required) {
			if (!$this->ClientSerNo->IsDetailKey && $this->ClientSerNo->FormValue != NULL && $this->ClientSerNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientSerNo->caption(), $this->ClientSerNo->RequiredErrorMessage));
			}
		}
		if ($this->ChargeCode->Required) {
			if (!$this->ChargeCode->IsDetailKey && $this->ChargeCode->FormValue != NULL && $this->ChargeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeCode->caption(), $this->ChargeCode->RequiredErrorMessage));
			}
		}
		if ($this->ItemID->Required) {
			if (!$this->ItemID->IsDetailKey && $this->ItemID->FormValue != NULL && $this->ItemID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ItemID->caption(), $this->ItemID->RequiredErrorMessage));
			}
		}
		if ($this->UnitCost->Required) {
			if (!$this->UnitCost->IsDetailKey && $this->UnitCost->FormValue != NULL && $this->UnitCost->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitCost->caption(), $this->UnitCost->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->UnitCost->FormValue)) {
			AddMessage($FormError, $this->UnitCost->errorMessage());
		}
		if ($this->Quantity->Required) {
			if (!$this->Quantity->IsDetailKey && $this->Quantity->FormValue != NULL && $this->Quantity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Quantity->caption(), $this->Quantity->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Quantity->FormValue)) {
			AddMessage($FormError, $this->Quantity->errorMessage());
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->AmountPaid->Required) {
			if (!$this->AmountPaid->IsDetailKey && $this->AmountPaid->FormValue != NULL && $this->AmountPaid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountPaid->caption(), $this->AmountPaid->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountPaid->FormValue)) {
			AddMessage($FormError, $this->AmountPaid->errorMessage());
		}
		if ($this->ReceiptNo->Required) {
			if (!$this->ReceiptNo->IsDetailKey && $this->ReceiptNo->FormValue != NULL && $this->ReceiptNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptNo->caption(), $this->ReceiptNo->RequiredErrorMessage));
			}
		}
		if ($this->ReceiptDate->Required) {
			if (!$this->ReceiptDate->IsDetailKey && $this->ReceiptDate->FormValue != NULL && $this->ReceiptDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptDate->caption(), $this->ReceiptDate->RequiredErrorMessage));
			}
		}
		if ($this->PaymentMethod->Required) {
			if (!$this->PaymentMethod->IsDetailKey && $this->PaymentMethod->FormValue != NULL && $this->PaymentMethod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentMethod->caption(), $this->PaymentMethod->RequiredErrorMessage));
			}
		}
		if ($this->PaymentRef->Required) {
			if (!$this->PaymentRef->IsDetailKey && $this->PaymentRef->FormValue != NULL && $this->PaymentRef->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentRef->caption(), $this->PaymentRef->RequiredErrorMessage));
			}
		}
		if ($this->CashierNo->Required) {
			if (!$this->CashierNo->IsDetailKey && $this->CashierNo->FormValue != NULL && $this->CashierNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CashierNo->caption(), $this->CashierNo->RequiredErrorMessage));
			}
		}
		if ($this->BillPeriod->Required) {
			if (!$this->BillPeriod->IsDetailKey && $this->BillPeriod->FormValue != NULL && $this->BillPeriod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillPeriod->caption(), $this->BillPeriod->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillPeriod->FormValue)) {
			AddMessage($FormError, $this->BillPeriod->errorMessage());
		}
		if ($this->BillYear->Required) {
			if (!$this->BillYear->IsDetailKey && $this->BillYear->FormValue != NULL && $this->BillYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillYear->caption(), $this->BillYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillYear->FormValue)) {
			AddMessage($FormError, $this->BillYear->errorMessage());
		}
		if ($this->ChargeGroup->Required) {
			if (!$this->ChargeGroup->IsDetailKey && $this->ChargeGroup->FormValue != NULL && $this->ChargeGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGroup->caption(), $this->ChargeGroup->RequiredErrorMessage));
			}
		}
		if ($this->ClientID->Required) {
			if (!$this->ClientID->IsDetailKey && $this->ClientID->FormValue != NULL && $this->ClientID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientID->caption(), $this->ClientID->RequiredErrorMessage));
			}
		}
		if ($this->PrintedReceipt->Required) {
			if (!$this->PrintedReceipt->IsDetailKey && $this->PrintedReceipt->FormValue != NULL && $this->PrintedReceipt->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PrintedReceipt->caption(), $this->PrintedReceipt->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check referential integrity for master table 'receipt'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_receipt_header();
		if (strval($this->ClientSerNo->CurrentValue) != "") {
			$masterFilter = str_replace("@ClientSerNo@", AdjustSql($this->ClientSerNo->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->ReceiptNo->CurrentValue) != "") {
			$masterFilter = str_replace("@ReceiptNo@", AdjustSql($this->ReceiptNo->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->PaymentMethod->CurrentValue) != "") {
			$masterFilter = str_replace("@PaymentMethod@", AdjustSql($this->PaymentMethod->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->ChargeGroup->CurrentValue) != "") {
			$masterFilter = str_replace("@ChargeGroup@", AdjustSql($this->ChargeGroup->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["receipt_header"]))
				$GLOBALS["receipt_header"] = new receipt_header();
			$rsmaster = $GLOBALS["receipt_header"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "receipt_header", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ClientSerNo
		$this->ClientSerNo->setDbValueDef($rsnew, $this->ClientSerNo->CurrentValue, 0, FALSE);

		// ChargeCode
		$this->ChargeCode->setDbValueDef($rsnew, $this->ChargeCode->CurrentValue, 0, FALSE);

		// ItemID
		$this->ItemID->setDbValueDef($rsnew, $this->ItemID->CurrentValue, "", FALSE);

		// UnitCost
		$this->UnitCost->setDbValueDef($rsnew, $this->UnitCost->CurrentValue, NULL, FALSE);

		// Quantity
		$this->Quantity->setDbValueDef($rsnew, $this->Quantity->CurrentValue, NULL, strval($this->Quantity->CurrentValue) == "");

		// UnitOfMeasure
		$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, strval($this->UnitOfMeasure->CurrentValue) == "");

		// AmountPaid
		$this->AmountPaid->setDbValueDef($rsnew, $this->AmountPaid->CurrentValue, NULL, FALSE);

		// ReceiptNo
		$this->ReceiptNo->setDbValueDef($rsnew, $this->ReceiptNo->CurrentValue, 0, FALSE);

		// ReceiptDate
		$this->ReceiptDate->CurrentValue = CurrentDate();
		$this->ReceiptDate->setDbValueDef($rsnew, $this->ReceiptDate->CurrentValue, NULL);

		// PaymentMethod
		$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, "", FALSE);

		// PaymentRef
		$this->PaymentRef->setDbValueDef($rsnew, $this->PaymentRef->CurrentValue, NULL, FALSE);

		// CashierNo
		$this->CashierNo->CurrentValue = CurrentUserName();
		$this->CashierNo->setDbValueDef($rsnew, $this->CashierNo->CurrentValue, NULL);

		// BillPeriod
		$this->BillPeriod->setDbValueDef($rsnew, $this->BillPeriod->CurrentValue, NULL, FALSE);

		// BillYear
		$this->BillYear->setDbValueDef($rsnew, $this->BillYear->CurrentValue, NULL, FALSE);

		// ChargeGroup
		$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, "", FALSE);

		// ClientID
		$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, FALSE);

		// PrintedReceipt
		$this->PrintedReceipt->setDbValueDef($rsnew, $this->PrintedReceipt->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ClientSerNo']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ChargeCode']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ItemID']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ReceiptNo']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter($rsnew);
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
		}
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "receipt_header") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ClientSerNo", Get("ClientSerNo"))) !== NULL) {
					$GLOBALS["receipt_header"]->ClientSerNo->setQueryStringValue($parm);
					$this->ClientSerNo->setQueryStringValue($GLOBALS["receipt_header"]->ClientSerNo->QueryStringValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->QueryStringValue);
					if (!is_numeric($GLOBALS["receipt_header"]->ClientSerNo->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ReceiptNo", Get("ReceiptNo"))) !== NULL) {
					$GLOBALS["receipt_header"]->ReceiptNo->setQueryStringValue($parm);
					$this->ReceiptNo->setQueryStringValue($GLOBALS["receipt_header"]->ReceiptNo->QueryStringValue);
					$this->ReceiptNo->setSessionValue($this->ReceiptNo->QueryStringValue);
					if (!is_numeric($GLOBALS["receipt_header"]->ReceiptNo->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_PaymentMethod", Get("PaymentMethod"))) !== NULL) {
					$GLOBALS["receipt_header"]->PaymentMethod->setQueryStringValue($parm);
					$this->PaymentMethod->setQueryStringValue($GLOBALS["receipt_header"]->PaymentMethod->QueryStringValue);
					$this->PaymentMethod->setSessionValue($this->PaymentMethod->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ChargeGroup", Get("ChargeGroup"))) !== NULL) {
					$GLOBALS["receipt_header"]->ChargeGroup->setQueryStringValue($parm);
					$this->ChargeGroup->setQueryStringValue($GLOBALS["receipt_header"]->ChargeGroup->QueryStringValue);
					$this->ChargeGroup->setSessionValue($this->ChargeGroup->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "receipt_header") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ClientSerNo", Post("ClientSerNo"))) !== NULL) {
					$GLOBALS["receipt_header"]->ClientSerNo->setFormValue($parm);
					$this->ClientSerNo->setFormValue($GLOBALS["receipt_header"]->ClientSerNo->FormValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->FormValue);
					if (!is_numeric($GLOBALS["receipt_header"]->ClientSerNo->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ReceiptNo", Post("ReceiptNo"))) !== NULL) {
					$GLOBALS["receipt_header"]->ReceiptNo->setFormValue($parm);
					$this->ReceiptNo->setFormValue($GLOBALS["receipt_header"]->ReceiptNo->FormValue);
					$this->ReceiptNo->setSessionValue($this->ReceiptNo->FormValue);
					if (!is_numeric($GLOBALS["receipt_header"]->ReceiptNo->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_PaymentMethod", Post("PaymentMethod"))) !== NULL) {
					$GLOBALS["receipt_header"]->PaymentMethod->setFormValue($parm);
					$this->PaymentMethod->setFormValue($GLOBALS["receipt_header"]->PaymentMethod->FormValue);
					$this->PaymentMethod->setSessionValue($this->PaymentMethod->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ChargeGroup", Post("ChargeGroup"))) !== NULL) {
					$GLOBALS["receipt_header"]->ChargeGroup->setFormValue($parm);
					$this->ChargeGroup->setFormValue($GLOBALS["receipt_header"]->ChargeGroup->FormValue);
					$this->ChargeGroup->setSessionValue($this->ChargeGroup->FormValue);
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "receipt_header") {
				if ($this->ClientSerNo->CurrentValue == "")
					$this->ClientSerNo->setSessionValue("");
				if ($this->ReceiptNo->CurrentValue == "")
					$this->ReceiptNo->setSessionValue("");
				if ($this->PaymentMethod->CurrentValue == "")
					$this->PaymentMethod->setSessionValue("");
				if ($this->ChargeGroup->CurrentValue == "")
					$this->ChargeGroup->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("receiptlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_ClientSerNo":
					break;
				case "x_ChargeCode":
					break;
				case "x_PaymentMethod":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_ClientSerNo":
							break;
						case "x_ChargeCode":
							break;
						case "x_PaymentMethod":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>