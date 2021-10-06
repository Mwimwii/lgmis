<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class bill_board_edit extends bill_board
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'bill_board';

	// Page object name
	public $PageObjName = "bill_board_edit";

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

		// Table object (bill_board)
		if (!isset($GLOBALS["bill_board"]) || get_class($GLOBALS["bill_board"]) == PROJECT_NAMESPACE . "bill_board") {
			$GLOBALS["bill_board"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["bill_board"];
		}

		// Table object (client)
		if (!isset($GLOBALS['client']))
			$GLOBALS['client'] = new client();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'bill_board');

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
		global $bill_board;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($bill_board);
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
					if ($pageName == "bill_boardview.php")
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
			$key .= @$ar['BillBoardNo'];
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->BillBoardNo->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $DisplayRecords = 1;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecordCount;

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
			if (!$Security->canEdit()) {
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("bill_boardlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->BillBoardNo->setVisibility();
		$this->BoardStandNo->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->ClientID->setVisibility();
		$this->BoardLength->setVisibility();
		$this->BoardWidth->setVisibility();
		$this->BoardSize->setVisibility();
		$this->BoardType->setVisibility();
		$this->BoardLocation->setVisibility();
		$this->BoardStatus->setVisibility();
		$this->ExemptCode->setVisibility();
		$this->StreetAddress->setVisibility();
		$this->Longitude->setVisibility();
		$this->Latitude->setVisibility();
		$this->Incumberance->setVisibility();
		$this->StartDate->setVisibility();
		$this->EndDate->setVisibility();
		$this->LastUpdatedBy->Visible = FALSE;
		$this->LastUpdateDate->Visible = FALSE;
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
		$this->setupLookupOptions($this->BoardType);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("bill_boardlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("BillBoardNo") !== NULL) {
				$this->BillBoardNo->setQueryStringValue(Get("BillBoardNo"));
				$this->BillBoardNo->setOldValue($this->BillBoardNo->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->BillBoardNo->setQueryStringValue(Key(0));
				$this->BillBoardNo->setOldValue($this->BillBoardNo->QueryStringValue);
			} elseif (Post("BillBoardNo") !== NULL) {
				$this->BillBoardNo->setFormValue(Post("BillBoardNo"));
				$this->BillBoardNo->setOldValue($this->BillBoardNo->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->BillBoardNo->setQueryStringValue(Route(2));
				$this->BillBoardNo->setOldValue($this->BillBoardNo->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_BillBoardNo")) {
					$this->BillBoardNo->setFormValue($CurrentForm->getValue("x_BillBoardNo"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("BillBoardNo") !== NULL) {
					$this->BillBoardNo->setQueryStringValue(Get("BillBoardNo"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->BillBoardNo->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->BillBoardNo->CurrentValue = NULL;
				}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load recordset
			$this->StartRecord = 1; // Initialize start position
			if ($rs = $this->loadRecordset()) // Load records
				$this->TotalRecords = $rs->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found
				if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
					$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate("bill_boardlist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->BillBoardNo->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->BillBoardNo->CurrentValue, $rs->fields('BillBoardNo'))) {
							$this->setStartRecordNumber($this->StartRecord); // Save record position
							$loaded = TRUE;
							break;
						} else {
							$this->StartRecord++;
							$rs->moveNext();
						}
					}
				}
			}

			// Load current row values
			if ($loaded)
				$this->loadRowValues($rs);
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
					$this->terminate("bill_boardlist.php"); // Return to list page
				} else {
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "bill_boardlist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'BillBoardNo' first before field var 'x_BillBoardNo'
		$val = $CurrentForm->hasValue("BillBoardNo") ? $CurrentForm->getValue("BillBoardNo") : $CurrentForm->getValue("x_BillBoardNo");
		if (!$this->BillBoardNo->IsDetailKey)
			$this->BillBoardNo->setFormValue($val);

		// Check field name 'BoardStandNo' first before field var 'x_BoardStandNo'
		$val = $CurrentForm->hasValue("BoardStandNo") ? $CurrentForm->getValue("BoardStandNo") : $CurrentForm->getValue("x_BoardStandNo");
		if (!$this->BoardStandNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardStandNo->Visible = FALSE; // Disable update for API request
			else
				$this->BoardStandNo->setFormValue($val);
		}

		// Check field name 'ClientSerNo' first before field var 'x_ClientSerNo'
		$val = $CurrentForm->hasValue("ClientSerNo") ? $CurrentForm->getValue("ClientSerNo") : $CurrentForm->getValue("x_ClientSerNo");
		if (!$this->ClientSerNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientSerNo->Visible = FALSE; // Disable update for API request
			else
				$this->ClientSerNo->setFormValue($val);
		}

		// Check field name 'ClientID' first before field var 'x_ClientID'
		$val = $CurrentForm->hasValue("ClientID") ? $CurrentForm->getValue("ClientID") : $CurrentForm->getValue("x_ClientID");
		if (!$this->ClientID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientID->Visible = FALSE; // Disable update for API request
			else
				$this->ClientID->setFormValue($val);
		}

		// Check field name 'BoardLength' first before field var 'x_BoardLength'
		$val = $CurrentForm->hasValue("BoardLength") ? $CurrentForm->getValue("BoardLength") : $CurrentForm->getValue("x_BoardLength");
		if (!$this->BoardLength->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardLength->Visible = FALSE; // Disable update for API request
			else
				$this->BoardLength->setFormValue($val);
		}

		// Check field name 'BoardWidth' first before field var 'x_BoardWidth'
		$val = $CurrentForm->hasValue("BoardWidth") ? $CurrentForm->getValue("BoardWidth") : $CurrentForm->getValue("x_BoardWidth");
		if (!$this->BoardWidth->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardWidth->Visible = FALSE; // Disable update for API request
			else
				$this->BoardWidth->setFormValue($val);
		}

		// Check field name 'BoardSize' first before field var 'x_BoardSize'
		$val = $CurrentForm->hasValue("BoardSize") ? $CurrentForm->getValue("BoardSize") : $CurrentForm->getValue("x_BoardSize");
		if (!$this->BoardSize->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardSize->Visible = FALSE; // Disable update for API request
			else
				$this->BoardSize->setFormValue($val);
		}

		// Check field name 'BoardType' first before field var 'x_BoardType'
		$val = $CurrentForm->hasValue("BoardType") ? $CurrentForm->getValue("BoardType") : $CurrentForm->getValue("x_BoardType");
		if (!$this->BoardType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardType->Visible = FALSE; // Disable update for API request
			else
				$this->BoardType->setFormValue($val);
		}

		// Check field name 'BoardLocation' first before field var 'x_BoardLocation'
		$val = $CurrentForm->hasValue("BoardLocation") ? $CurrentForm->getValue("BoardLocation") : $CurrentForm->getValue("x_BoardLocation");
		if (!$this->BoardLocation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardLocation->Visible = FALSE; // Disable update for API request
			else
				$this->BoardLocation->setFormValue($val);
		}

		// Check field name 'BoardStatus' first before field var 'x_BoardStatus'
		$val = $CurrentForm->hasValue("BoardStatus") ? $CurrentForm->getValue("BoardStatus") : $CurrentForm->getValue("x_BoardStatus");
		if (!$this->BoardStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardStatus->Visible = FALSE; // Disable update for API request
			else
				$this->BoardStatus->setFormValue($val);
		}

		// Check field name 'ExemptCode' first before field var 'x_ExemptCode'
		$val = $CurrentForm->hasValue("ExemptCode") ? $CurrentForm->getValue("ExemptCode") : $CurrentForm->getValue("x_ExemptCode");
		if (!$this->ExemptCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExemptCode->Visible = FALSE; // Disable update for API request
			else
				$this->ExemptCode->setFormValue($val);
		}

		// Check field name 'StreetAddress' first before field var 'x_StreetAddress'
		$val = $CurrentForm->hasValue("StreetAddress") ? $CurrentForm->getValue("StreetAddress") : $CurrentForm->getValue("x_StreetAddress");
		if (!$this->StreetAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->StreetAddress->Visible = FALSE; // Disable update for API request
			else
				$this->StreetAddress->setFormValue($val);
		}

		// Check field name 'Longitude' first before field var 'x_Longitude'
		$val = $CurrentForm->hasValue("Longitude") ? $CurrentForm->getValue("Longitude") : $CurrentForm->getValue("x_Longitude");
		if (!$this->Longitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Longitude->Visible = FALSE; // Disable update for API request
			else
				$this->Longitude->setFormValue($val);
		}

		// Check field name 'Latitude' first before field var 'x_Latitude'
		$val = $CurrentForm->hasValue("Latitude") ? $CurrentForm->getValue("Latitude") : $CurrentForm->getValue("x_Latitude");
		if (!$this->Latitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Latitude->Visible = FALSE; // Disable update for API request
			else
				$this->Latitude->setFormValue($val);
		}

		// Check field name 'Incumberance' first before field var 'x_Incumberance'
		$val = $CurrentForm->hasValue("Incumberance") ? $CurrentForm->getValue("Incumberance") : $CurrentForm->getValue("x_Incumberance");
		if (!$this->Incumberance->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Incumberance->Visible = FALSE; // Disable update for API request
			else
				$this->Incumberance->setFormValue($val);
		}

		// Check field name 'StartDate' first before field var 'x_StartDate'
		$val = $CurrentForm->hasValue("StartDate") ? $CurrentForm->getValue("StartDate") : $CurrentForm->getValue("x_StartDate");
		if (!$this->StartDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->StartDate->Visible = FALSE; // Disable update for API request
			else
				$this->StartDate->setFormValue($val);
			$this->StartDate->CurrentValue = UnFormatDateTime($this->StartDate->CurrentValue, 0);
		}

		// Check field name 'EndDate' first before field var 'x_EndDate'
		$val = $CurrentForm->hasValue("EndDate") ? $CurrentForm->getValue("EndDate") : $CurrentForm->getValue("x_EndDate");
		if (!$this->EndDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EndDate->Visible = FALSE; // Disable update for API request
			else
				$this->EndDate->setFormValue($val);
			$this->EndDate->CurrentValue = UnFormatDateTime($this->EndDate->CurrentValue, 0);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->BillBoardNo->CurrentValue = $this->BillBoardNo->FormValue;
		$this->BoardStandNo->CurrentValue = $this->BoardStandNo->FormValue;
		$this->ClientSerNo->CurrentValue = $this->ClientSerNo->FormValue;
		$this->ClientID->CurrentValue = $this->ClientID->FormValue;
		$this->BoardLength->CurrentValue = $this->BoardLength->FormValue;
		$this->BoardWidth->CurrentValue = $this->BoardWidth->FormValue;
		$this->BoardSize->CurrentValue = $this->BoardSize->FormValue;
		$this->BoardType->CurrentValue = $this->BoardType->FormValue;
		$this->BoardLocation->CurrentValue = $this->BoardLocation->FormValue;
		$this->BoardStatus->CurrentValue = $this->BoardStatus->FormValue;
		$this->ExemptCode->CurrentValue = $this->ExemptCode->FormValue;
		$this->StreetAddress->CurrentValue = $this->StreetAddress->FormValue;
		$this->Longitude->CurrentValue = $this->Longitude->FormValue;
		$this->Latitude->CurrentValue = $this->Latitude->FormValue;
		$this->Incumberance->CurrentValue = $this->Incumberance->FormValue;
		$this->StartDate->CurrentValue = $this->StartDate->FormValue;
		$this->StartDate->CurrentValue = UnFormatDateTime($this->StartDate->CurrentValue, 0);
		$this->EndDate->CurrentValue = $this->EndDate->FormValue;
		$this->EndDate->CurrentValue = UnFormatDateTime($this->EndDate->CurrentValue, 0);
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->BillBoardNo->setDbValue($row['BillBoardNo']);
		$this->BoardStandNo->setDbValue($row['BoardStandNo']);
		$this->ClientSerNo->setDbValue($row['ClientSerNo']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->BoardLength->setDbValue($row['BoardLength']);
		$this->BoardWidth->setDbValue($row['BoardWidth']);
		$this->BoardSize->setDbValue($row['BoardSize']);
		$this->BoardType->setDbValue($row['BoardType']);
		$this->BoardLocation->setDbValue($row['BoardLocation']);
		$this->BoardStatus->setDbValue($row['BoardStatus']);
		$this->ExemptCode->setDbValue($row['ExemptCode']);
		$this->StreetAddress->setDbValue($row['StreetAddress']);
		$this->Longitude->setDbValue($row['Longitude']);
		$this->Latitude->setDbValue($row['Latitude']);
		$this->Incumberance->setDbValue($row['Incumberance']);
		$this->StartDate->setDbValue($row['StartDate']);
		$this->EndDate->setDbValue($row['EndDate']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['BillBoardNo'] = NULL;
		$row['BoardStandNo'] = NULL;
		$row['ClientSerNo'] = NULL;
		$row['ClientID'] = NULL;
		$row['BoardLength'] = NULL;
		$row['BoardWidth'] = NULL;
		$row['BoardSize'] = NULL;
		$row['BoardType'] = NULL;
		$row['BoardLocation'] = NULL;
		$row['BoardStatus'] = NULL;
		$row['ExemptCode'] = NULL;
		$row['StreetAddress'] = NULL;
		$row['Longitude'] = NULL;
		$row['Latitude'] = NULL;
		$row['Incumberance'] = NULL;
		$row['StartDate'] = NULL;
		$row['EndDate'] = NULL;
		$row['LastUpdatedBy'] = NULL;
		$row['LastUpdateDate'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("BillBoardNo")) != "")
			$this->BillBoardNo->OldValue = $this->getKey("BillBoardNo"); // BillBoardNo
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

		if ($this->BoardLength->FormValue == $this->BoardLength->CurrentValue && is_numeric(ConvertToFloatString($this->BoardLength->CurrentValue)))
			$this->BoardLength->CurrentValue = ConvertToFloatString($this->BoardLength->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BoardWidth->FormValue == $this->BoardWidth->CurrentValue && is_numeric(ConvertToFloatString($this->BoardWidth->CurrentValue)))
			$this->BoardWidth->CurrentValue = ConvertToFloatString($this->BoardWidth->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BoardSize->FormValue == $this->BoardSize->CurrentValue && is_numeric(ConvertToFloatString($this->BoardSize->CurrentValue)))
			$this->BoardSize->CurrentValue = ConvertToFloatString($this->BoardSize->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Longitude->FormValue == $this->Longitude->CurrentValue && is_numeric(ConvertToFloatString($this->Longitude->CurrentValue)))
			$this->Longitude->CurrentValue = ConvertToFloatString($this->Longitude->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Latitude->FormValue == $this->Latitude->CurrentValue && is_numeric(ConvertToFloatString($this->Latitude->CurrentValue)))
			$this->Latitude->CurrentValue = ConvertToFloatString($this->Latitude->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// BillBoardNo
		// BoardStandNo
		// ClientSerNo
		// ClientID
		// BoardLength
		// BoardWidth
		// BoardSize
		// BoardType
		// BoardLocation
		// BoardStatus
		// ExemptCode
		// StreetAddress
		// Longitude
		// Latitude
		// Incumberance
		// StartDate
		// EndDate
		// LastUpdatedBy
		// LastUpdateDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// BillBoardNo
			$this->BillBoardNo->ViewValue = $this->BillBoardNo->CurrentValue;
			$this->BillBoardNo->ViewCustomAttributes = "";

			// BoardStandNo
			$this->BoardStandNo->ViewValue = $this->BoardStandNo->CurrentValue;
			$this->BoardStandNo->ViewCustomAttributes = "";

			// ClientSerNo
			$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
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
						$arwrk[3] = $rswrk->fields('df3');
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

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$this->ClientID->ViewCustomAttributes = "";

			// BoardLength
			$this->BoardLength->ViewValue = $this->BoardLength->CurrentValue;
			$this->BoardLength->ViewValue = FormatNumber($this->BoardLength->ViewValue, 2, -2, -2, -2);
			$this->BoardLength->CellCssStyle .= "text-align: right;";
			$this->BoardLength->ViewCustomAttributes = "";

			// BoardWidth
			$this->BoardWidth->ViewValue = $this->BoardWidth->CurrentValue;
			$this->BoardWidth->ViewValue = FormatNumber($this->BoardWidth->ViewValue, 2, -2, -2, -2);
			$this->BoardWidth->CellCssStyle .= "text-align: right;";
			$this->BoardWidth->ViewCustomAttributes = "";

			// BoardSize
			$this->BoardSize->ViewValue = $this->BoardSize->CurrentValue;
			$this->BoardSize->ViewValue = FormatNumber($this->BoardSize->ViewValue, 2, -2, -2, -2);
			$this->BoardSize->CellCssStyle .= "text-align: right;";
			$this->BoardSize->ViewCustomAttributes = "";

			// BoardType
			$curVal = strval($this->BoardType->CurrentValue);
			if ($curVal != "") {
				$this->BoardType->ViewValue = $this->BoardType->lookupCacheOption($curVal);
				if ($this->BoardType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`BoardType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BoardType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->BoardType->ViewValue = $this->BoardType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BoardType->ViewValue = $this->BoardType->CurrentValue;
					}
				}
			} else {
				$this->BoardType->ViewValue = NULL;
			}
			$this->BoardType->ViewCustomAttributes = "";

			// BoardLocation
			$this->BoardLocation->ViewValue = $this->BoardLocation->CurrentValue;
			$this->BoardLocation->ViewCustomAttributes = "";

			// BoardStatus
			$this->BoardStatus->ViewValue = $this->BoardStatus->CurrentValue;
			$this->BoardStatus->ViewCustomAttributes = "";

			// ExemptCode
			$this->ExemptCode->ViewValue = $this->ExemptCode->CurrentValue;
			$this->ExemptCode->ViewCustomAttributes = "";

			// StreetAddress
			$this->StreetAddress->ViewValue = $this->StreetAddress->CurrentValue;
			$this->StreetAddress->ViewCustomAttributes = "";

			// Longitude
			$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
			$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Longitude->ViewCustomAttributes = "";

			// Latitude
			$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
			$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Latitude->ViewCustomAttributes = "";

			// Incumberance
			$this->Incumberance->ViewValue = $this->Incumberance->CurrentValue;
			$this->Incumberance->ViewCustomAttributes = "";

			// StartDate
			$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
			$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
			$this->StartDate->ViewCustomAttributes = "";

			// EndDate
			$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
			$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
			$this->EndDate->ViewCustomAttributes = "";

			// BillBoardNo
			$this->BillBoardNo->LinkCustomAttributes = "";
			$this->BillBoardNo->HrefValue = "";
			$this->BillBoardNo->TooltipValue = "";

			// BoardStandNo
			$this->BoardStandNo->LinkCustomAttributes = "";
			$this->BoardStandNo->HrefValue = "";
			$this->BoardStandNo->TooltipValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// BoardLength
			$this->BoardLength->LinkCustomAttributes = "";
			$this->BoardLength->HrefValue = "";
			$this->BoardLength->TooltipValue = "";

			// BoardWidth
			$this->BoardWidth->LinkCustomAttributes = "";
			$this->BoardWidth->HrefValue = "";
			$this->BoardWidth->TooltipValue = "";

			// BoardSize
			$this->BoardSize->LinkCustomAttributes = "";
			$this->BoardSize->HrefValue = "";
			$this->BoardSize->TooltipValue = "";

			// BoardType
			$this->BoardType->LinkCustomAttributes = "";
			$this->BoardType->HrefValue = "";
			$this->BoardType->TooltipValue = "";

			// BoardLocation
			$this->BoardLocation->LinkCustomAttributes = "";
			$this->BoardLocation->HrefValue = "";
			$this->BoardLocation->TooltipValue = "";

			// BoardStatus
			$this->BoardStatus->LinkCustomAttributes = "";
			$this->BoardStatus->HrefValue = "";
			$this->BoardStatus->TooltipValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";
			$this->ExemptCode->TooltipValue = "";

			// StreetAddress
			$this->StreetAddress->LinkCustomAttributes = "";
			$this->StreetAddress->HrefValue = "";
			$this->StreetAddress->TooltipValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";
			$this->Longitude->TooltipValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";
			$this->Latitude->TooltipValue = "";

			// Incumberance
			$this->Incumberance->LinkCustomAttributes = "";
			$this->Incumberance->HrefValue = "";
			$this->Incumberance->TooltipValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";
			$this->StartDate->TooltipValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";
			$this->EndDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// BillBoardNo
			$this->BillBoardNo->EditAttrs["class"] = "form-control";
			$this->BillBoardNo->EditCustomAttributes = "";
			$this->BillBoardNo->EditValue = $this->BillBoardNo->CurrentValue;
			$this->BillBoardNo->ViewCustomAttributes = "";

			// BoardStandNo
			$this->BoardStandNo->EditAttrs["class"] = "form-control";
			$this->BoardStandNo->EditCustomAttributes = "";
			if (!$this->BoardStandNo->Raw)
				$this->BoardStandNo->CurrentValue = HtmlDecode($this->BoardStandNo->CurrentValue);
			$this->BoardStandNo->EditValue = HtmlEncode($this->BoardStandNo->CurrentValue);
			$this->BoardStandNo->PlaceHolder = RemoveHtml($this->BoardStandNo->caption());

			// ClientSerNo
			$this->ClientSerNo->EditAttrs["class"] = "form-control";
			$this->ClientSerNo->EditCustomAttributes = "";
			if ($this->ClientSerNo->getSessionValue() != "") {
				$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
				$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
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
							$arwrk[3] = $rswrk->fields('df3');
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
				$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
				$curVal = strval($this->ClientSerNo->CurrentValue);
				if ($curVal != "") {
					$this->ClientSerNo->EditValue = $this->ClientSerNo->lookupCacheOption($curVal);
					if ($this->ClientSerNo->EditValue === NULL) { // Lookup from database
						$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
							$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
							$this->ClientSerNo->EditValue = $this->ClientSerNo->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
						}
					}
				} else {
					$this->ClientSerNo->EditValue = NULL;
				}
				$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());
			}

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// BoardLength
			$this->BoardLength->EditAttrs["class"] = "form-control";
			$this->BoardLength->EditCustomAttributes = "";
			$this->BoardLength->EditValue = HtmlEncode($this->BoardLength->CurrentValue);
			$this->BoardLength->PlaceHolder = RemoveHtml($this->BoardLength->caption());
			if (strval($this->BoardLength->EditValue) != "" && is_numeric($this->BoardLength->EditValue))
				$this->BoardLength->EditValue = FormatNumber($this->BoardLength->EditValue, -2, -2, -2, -2);
			

			// BoardWidth
			$this->BoardWidth->EditAttrs["class"] = "form-control";
			$this->BoardWidth->EditCustomAttributes = "";
			$this->BoardWidth->EditValue = HtmlEncode($this->BoardWidth->CurrentValue);
			$this->BoardWidth->PlaceHolder = RemoveHtml($this->BoardWidth->caption());
			if (strval($this->BoardWidth->EditValue) != "" && is_numeric($this->BoardWidth->EditValue))
				$this->BoardWidth->EditValue = FormatNumber($this->BoardWidth->EditValue, -2, -2, -2, -2);
			

			// BoardSize
			$this->BoardSize->EditAttrs["class"] = "form-control";
			$this->BoardSize->EditCustomAttributes = "";
			$this->BoardSize->EditValue = HtmlEncode($this->BoardSize->CurrentValue);
			$this->BoardSize->PlaceHolder = RemoveHtml($this->BoardSize->caption());
			if (strval($this->BoardSize->EditValue) != "" && is_numeric($this->BoardSize->EditValue))
				$this->BoardSize->EditValue = FormatNumber($this->BoardSize->EditValue, -2, -2, -2, -2);
			

			// BoardType
			$this->BoardType->EditAttrs["class"] = "form-control";
			$this->BoardType->EditCustomAttributes = "";
			$curVal = trim(strval($this->BoardType->CurrentValue));
			if ($curVal != "")
				$this->BoardType->ViewValue = $this->BoardType->lookupCacheOption($curVal);
			else
				$this->BoardType->ViewValue = $this->BoardType->Lookup !== NULL && is_array($this->BoardType->Lookup->Options) ? $curVal : NULL;
			if ($this->BoardType->ViewValue !== NULL) { // Load from cache
				$this->BoardType->EditValue = array_values($this->BoardType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`BoardType`" . SearchString("=", $this->BoardType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BoardType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BoardType->EditValue = $arwrk;
			}

			// BoardLocation
			$this->BoardLocation->EditAttrs["class"] = "form-control";
			$this->BoardLocation->EditCustomAttributes = "";
			if (!$this->BoardLocation->Raw)
				$this->BoardLocation->CurrentValue = HtmlDecode($this->BoardLocation->CurrentValue);
			$this->BoardLocation->EditValue = HtmlEncode($this->BoardLocation->CurrentValue);
			$this->BoardLocation->PlaceHolder = RemoveHtml($this->BoardLocation->caption());

			// BoardStatus
			$this->BoardStatus->EditAttrs["class"] = "form-control";
			$this->BoardStatus->EditCustomAttributes = "";
			$this->BoardStatus->EditValue = HtmlEncode($this->BoardStatus->CurrentValue);
			$this->BoardStatus->PlaceHolder = RemoveHtml($this->BoardStatus->caption());

			// ExemptCode
			$this->ExemptCode->EditAttrs["class"] = "form-control";
			$this->ExemptCode->EditCustomAttributes = "";
			$this->ExemptCode->EditValue = HtmlEncode($this->ExemptCode->CurrentValue);
			$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

			// StreetAddress
			$this->StreetAddress->EditAttrs["class"] = "form-control";
			$this->StreetAddress->EditCustomAttributes = "";
			if (!$this->StreetAddress->Raw)
				$this->StreetAddress->CurrentValue = HtmlDecode($this->StreetAddress->CurrentValue);
			$this->StreetAddress->EditValue = HtmlEncode($this->StreetAddress->CurrentValue);
			$this->StreetAddress->PlaceHolder = RemoveHtml($this->StreetAddress->caption());

			// Longitude
			$this->Longitude->EditAttrs["class"] = "form-control";
			$this->Longitude->EditCustomAttributes = "";
			$this->Longitude->EditValue = HtmlEncode($this->Longitude->CurrentValue);
			$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
			if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue))
				$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -1, -2, 0);
			

			// Latitude
			$this->Latitude->EditAttrs["class"] = "form-control";
			$this->Latitude->EditCustomAttributes = "";
			$this->Latitude->EditValue = HtmlEncode($this->Latitude->CurrentValue);
			$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
			if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue))
				$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -1, -2, 0);
			

			// Incumberance
			$this->Incumberance->EditAttrs["class"] = "form-control";
			$this->Incumberance->EditCustomAttributes = "";
			if (!$this->Incumberance->Raw)
				$this->Incumberance->CurrentValue = HtmlDecode($this->Incumberance->CurrentValue);
			$this->Incumberance->EditValue = HtmlEncode($this->Incumberance->CurrentValue);
			$this->Incumberance->PlaceHolder = RemoveHtml($this->Incumberance->caption());

			// StartDate
			$this->StartDate->EditAttrs["class"] = "form-control";
			$this->StartDate->EditCustomAttributes = "";
			$this->StartDate->EditValue = HtmlEncode(FormatDateTime($this->StartDate->CurrentValue, 8));
			$this->StartDate->PlaceHolder = RemoveHtml($this->StartDate->caption());

			// EndDate
			$this->EndDate->EditAttrs["class"] = "form-control";
			$this->EndDate->EditCustomAttributes = "";
			$this->EndDate->EditValue = HtmlEncode(FormatDateTime($this->EndDate->CurrentValue, 8));
			$this->EndDate->PlaceHolder = RemoveHtml($this->EndDate->caption());

			// Edit refer script
			// BillBoardNo

			$this->BillBoardNo->LinkCustomAttributes = "";
			$this->BillBoardNo->HrefValue = "";

			// BoardStandNo
			$this->BoardStandNo->LinkCustomAttributes = "";
			$this->BoardStandNo->HrefValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";

			// BoardLength
			$this->BoardLength->LinkCustomAttributes = "";
			$this->BoardLength->HrefValue = "";

			// BoardWidth
			$this->BoardWidth->LinkCustomAttributes = "";
			$this->BoardWidth->HrefValue = "";

			// BoardSize
			$this->BoardSize->LinkCustomAttributes = "";
			$this->BoardSize->HrefValue = "";

			// BoardType
			$this->BoardType->LinkCustomAttributes = "";
			$this->BoardType->HrefValue = "";

			// BoardLocation
			$this->BoardLocation->LinkCustomAttributes = "";
			$this->BoardLocation->HrefValue = "";

			// BoardStatus
			$this->BoardStatus->LinkCustomAttributes = "";
			$this->BoardStatus->HrefValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";

			// StreetAddress
			$this->StreetAddress->LinkCustomAttributes = "";
			$this->StreetAddress->HrefValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";

			// Incumberance
			$this->Incumberance->LinkCustomAttributes = "";
			$this->Incumberance->HrefValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";
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
		if ($this->BillBoardNo->Required) {
			if (!$this->BillBoardNo->IsDetailKey && $this->BillBoardNo->FormValue != NULL && $this->BillBoardNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillBoardNo->caption(), $this->BillBoardNo->RequiredErrorMessage));
			}
		}
		if ($this->BoardStandNo->Required) {
			if (!$this->BoardStandNo->IsDetailKey && $this->BoardStandNo->FormValue != NULL && $this->BoardStandNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardStandNo->caption(), $this->BoardStandNo->RequiredErrorMessage));
			}
		}
		if ($this->ClientSerNo->Required) {
			if (!$this->ClientSerNo->IsDetailKey && $this->ClientSerNo->FormValue != NULL && $this->ClientSerNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientSerNo->caption(), $this->ClientSerNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ClientSerNo->FormValue)) {
			AddMessage($FormError, $this->ClientSerNo->errorMessage());
		}
		if ($this->ClientID->Required) {
			if (!$this->ClientID->IsDetailKey && $this->ClientID->FormValue != NULL && $this->ClientID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientID->caption(), $this->ClientID->RequiredErrorMessage));
			}
		}
		if ($this->BoardLength->Required) {
			if (!$this->BoardLength->IsDetailKey && $this->BoardLength->FormValue != NULL && $this->BoardLength->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardLength->caption(), $this->BoardLength->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BoardLength->FormValue)) {
			AddMessage($FormError, $this->BoardLength->errorMessage());
		}
		if ($this->BoardWidth->Required) {
			if (!$this->BoardWidth->IsDetailKey && $this->BoardWidth->FormValue != NULL && $this->BoardWidth->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardWidth->caption(), $this->BoardWidth->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BoardWidth->FormValue)) {
			AddMessage($FormError, $this->BoardWidth->errorMessage());
		}
		if ($this->BoardSize->Required) {
			if (!$this->BoardSize->IsDetailKey && $this->BoardSize->FormValue != NULL && $this->BoardSize->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardSize->caption(), $this->BoardSize->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BoardSize->FormValue)) {
			AddMessage($FormError, $this->BoardSize->errorMessage());
		}
		if ($this->BoardType->Required) {
			if (!$this->BoardType->IsDetailKey && $this->BoardType->FormValue != NULL && $this->BoardType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardType->caption(), $this->BoardType->RequiredErrorMessage));
			}
		}
		if ($this->BoardLocation->Required) {
			if (!$this->BoardLocation->IsDetailKey && $this->BoardLocation->FormValue != NULL && $this->BoardLocation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardLocation->caption(), $this->BoardLocation->RequiredErrorMessage));
			}
		}
		if ($this->BoardStatus->Required) {
			if (!$this->BoardStatus->IsDetailKey && $this->BoardStatus->FormValue != NULL && $this->BoardStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardStatus->caption(), $this->BoardStatus->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BoardStatus->FormValue)) {
			AddMessage($FormError, $this->BoardStatus->errorMessage());
		}
		if ($this->ExemptCode->Required) {
			if (!$this->ExemptCode->IsDetailKey && $this->ExemptCode->FormValue != NULL && $this->ExemptCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExemptCode->caption(), $this->ExemptCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ExemptCode->FormValue)) {
			AddMessage($FormError, $this->ExemptCode->errorMessage());
		}
		if ($this->StreetAddress->Required) {
			if (!$this->StreetAddress->IsDetailKey && $this->StreetAddress->FormValue != NULL && $this->StreetAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StreetAddress->caption(), $this->StreetAddress->RequiredErrorMessage));
			}
		}
		if ($this->Longitude->Required) {
			if (!$this->Longitude->IsDetailKey && $this->Longitude->FormValue != NULL && $this->Longitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Longitude->caption(), $this->Longitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Longitude->FormValue)) {
			AddMessage($FormError, $this->Longitude->errorMessage());
		}
		if ($this->Latitude->Required) {
			if (!$this->Latitude->IsDetailKey && $this->Latitude->FormValue != NULL && $this->Latitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Latitude->caption(), $this->Latitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Latitude->FormValue)) {
			AddMessage($FormError, $this->Latitude->errorMessage());
		}
		if ($this->Incumberance->Required) {
			if (!$this->Incumberance->IsDetailKey && $this->Incumberance->FormValue != NULL && $this->Incumberance->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Incumberance->caption(), $this->Incumberance->RequiredErrorMessage));
			}
		}
		if ($this->StartDate->Required) {
			if (!$this->StartDate->IsDetailKey && $this->StartDate->FormValue != NULL && $this->StartDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StartDate->caption(), $this->StartDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->StartDate->FormValue)) {
			AddMessage($FormError, $this->StartDate->errorMessage());
		}
		if ($this->EndDate->Required) {
			if (!$this->EndDate->IsDetailKey && $this->EndDate->FormValue != NULL && $this->EndDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EndDate->caption(), $this->EndDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->EndDate->FormValue)) {
			AddMessage($FormError, $this->EndDate->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("bill_board_account", $detailTblVar) && $GLOBALS["bill_board_account"]->DetailEdit) {
			if (!isset($GLOBALS["bill_board_account_grid"]))
				$GLOBALS["bill_board_account_grid"] = new bill_board_account_grid(); // Get detail page object
			$GLOBALS["bill_board_account_grid"]->validateGridForm();
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// BoardStandNo
			$this->BoardStandNo->setDbValueDef($rsnew, $this->BoardStandNo->CurrentValue, NULL, $this->BoardStandNo->ReadOnly);

			// ClientSerNo
			$this->ClientSerNo->setDbValueDef($rsnew, $this->ClientSerNo->CurrentValue, NULL, $this->ClientSerNo->ReadOnly);

			// ClientID
			$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, $this->ClientID->ReadOnly);

			// BoardLength
			$this->BoardLength->setDbValueDef($rsnew, $this->BoardLength->CurrentValue, NULL, $this->BoardLength->ReadOnly);

			// BoardWidth
			$this->BoardWidth->setDbValueDef($rsnew, $this->BoardWidth->CurrentValue, NULL, $this->BoardWidth->ReadOnly);

			// BoardSize
			$this->BoardSize->setDbValueDef($rsnew, $this->BoardSize->CurrentValue, NULL, $this->BoardSize->ReadOnly);

			// BoardType
			$this->BoardType->setDbValueDef($rsnew, $this->BoardType->CurrentValue, NULL, $this->BoardType->ReadOnly);

			// BoardLocation
			$this->BoardLocation->setDbValueDef($rsnew, $this->BoardLocation->CurrentValue, NULL, $this->BoardLocation->ReadOnly);

			// BoardStatus
			$this->BoardStatus->setDbValueDef($rsnew, $this->BoardStatus->CurrentValue, NULL, $this->BoardStatus->ReadOnly);

			// ExemptCode
			$this->ExemptCode->setDbValueDef($rsnew, $this->ExemptCode->CurrentValue, NULL, $this->ExemptCode->ReadOnly);

			// StreetAddress
			$this->StreetAddress->setDbValueDef($rsnew, $this->StreetAddress->CurrentValue, NULL, $this->StreetAddress->ReadOnly);

			// Longitude
			$this->Longitude->setDbValueDef($rsnew, $this->Longitude->CurrentValue, NULL, $this->Longitude->ReadOnly);

			// Latitude
			$this->Latitude->setDbValueDef($rsnew, $this->Latitude->CurrentValue, NULL, $this->Latitude->ReadOnly);

			// Incumberance
			$this->Incumberance->setDbValueDef($rsnew, $this->Incumberance->CurrentValue, NULL, $this->Incumberance->ReadOnly);

			// StartDate
			$this->StartDate->setDbValueDef($rsnew, UnFormatDateTime($this->StartDate->CurrentValue, 0), NULL, $this->StartDate->ReadOnly);

			// EndDate
			$this->EndDate->setDbValueDef($rsnew, UnFormatDateTime($this->EndDate->CurrentValue, 0), NULL, $this->EndDate->ReadOnly);

			// Check referential integrity for master table 'client'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_client();
			$keyValue = isset($rsnew['ClientSerNo']) ? $rsnew['ClientSerNo'] : $rsold['ClientSerNo'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@ClientSerNo@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["client"]))
					$GLOBALS["client"] = new client();
				$rsmaster = $GLOBALS["client"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "client", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("bill_board_account", $detailTblVar) && $GLOBALS["bill_board_account"]->DetailEdit) {
						if (!isset($GLOBALS["bill_board_account_grid"]))
							$GLOBALS["bill_board_account_grid"] = new bill_board_account_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "bill_board_account"); // Load user level of detail table
						$editRow = $GLOBALS["bill_board_account_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
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
			if ($masterTblVar == "client") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ClientSerNo", Get("ClientSerNo"))) !== NULL) {
					$GLOBALS["client"]->ClientSerNo->setQueryStringValue($parm);
					$this->ClientSerNo->setQueryStringValue($GLOBALS["client"]->ClientSerNo->QueryStringValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->QueryStringValue);
					if (!is_numeric($GLOBALS["client"]->ClientSerNo->QueryStringValue))
						$validMaster = FALSE;
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
			if ($masterTblVar == "client") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ClientSerNo", Post("ClientSerNo"))) !== NULL) {
					$GLOBALS["client"]->ClientSerNo->setFormValue($parm);
					$this->ClientSerNo->setFormValue($GLOBALS["client"]->ClientSerNo->FormValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->FormValue);
					if (!is_numeric($GLOBALS["client"]->ClientSerNo->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "client") {
				if ($this->ClientSerNo->CurrentValue == "")
					$this->ClientSerNo->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("bill_board_account", $detailTblVar)) {
				if (!isset($GLOBALS["bill_board_account_grid"]))
					$GLOBALS["bill_board_account_grid"] = new bill_board_account_grid();
				if ($GLOBALS["bill_board_account_grid"]->DetailEdit) {
					$GLOBALS["bill_board_account_grid"]->CurrentMode = "edit";
					$GLOBALS["bill_board_account_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["bill_board_account_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["bill_board_account_grid"]->setStartRecordNumber(1);
					$GLOBALS["bill_board_account_grid"]->BillBoardNo->IsDetailKey = TRUE;
					$GLOBALS["bill_board_account_grid"]->BillBoardNo->CurrentValue = $this->BillBoardNo->CurrentValue;
					$GLOBALS["bill_board_account_grid"]->BillBoardNo->setSessionValue($GLOBALS["bill_board_account_grid"]->BillBoardNo->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("bill_boardlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_BoardType":
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
						case "x_BoardType":
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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