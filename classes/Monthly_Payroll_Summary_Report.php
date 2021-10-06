<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for Monthly Payroll Summary Report
 */
class Monthly_Payroll_Summary_Report extends CrosstabTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $LocalAuthority;
	public $DepartmentName;
	public $SectionName;
	public $EmployeeID;
	public $Title;
	public $Surname;
	public $FirstName;
	public $MiddleName;
	public $Sex;
	public $NRC;
	public $SalaryScale;
	public $Division;
	public $PositionName;
	public $PaymentMethod;
	public $BankBranchCode;
	public $BankAccountNo;
	public $PaidPosition;
	public $PayrollPeriod;
	public $AmtType;
	public $PCode;
	public $Amount;
	public $Period;
	public $PayCode;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Monthly_Payroll_Summary_Report';
		$this->TableName = 'Monthly Payroll Summary Report';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`monthly_payroll_summary_view`";
		$this->ReportSourceTable = '_monthly_payroll_summary_view'; // Report source table
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (report only)
		$this->ExportPageOrientation = "landscape"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

		// LocalAuthority
		$this->LocalAuthority = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_LocalAuthority', 'LocalAuthority', '`LocalAuthority`', '`LocalAuthority`', 200, 40, -1, FALSE, '`LocalAuthority`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LocalAuthority->Nullable = FALSE; // NOT NULL field
		$this->LocalAuthority->Required = TRUE; // Required field
		$this->LocalAuthority->Sortable = TRUE; // Allow sort
		$this->LocalAuthority->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['LocalAuthority'] = &$this->LocalAuthority;

		// DepartmentName
		$this->DepartmentName = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_DepartmentName', 'DepartmentName', '`DepartmentName`', '`DepartmentName`', 200, 255, -1, FALSE, '`DepartmentName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentName->GroupingFieldId = 1;
		$this->DepartmentName->Nullable = FALSE; // NOT NULL field
		$this->DepartmentName->Required = TRUE; // Required field
		$this->DepartmentName->Sortable = TRUE; // Allow sort
		$this->DepartmentName->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['DepartmentName'] = &$this->DepartmentName;

		// SectionName
		$this->SectionName = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_SectionName', 'SectionName', '`SectionName`', '`SectionName`', 200, 255, -1, FALSE, '`SectionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SectionName->Nullable = FALSE; // NOT NULL field
		$this->SectionName->Required = TRUE; // Required field
		$this->SectionName->Sortable = TRUE; // Allow sort
		$this->SectionName->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['SectionName'] = &$this->SectionName;

		// EmployeeID
		$this->EmployeeID = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->GroupingFieldId = 2;
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->EmployeeID->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// Title
		$this->Title = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_Title', 'Title', '`Title`', '`Title`', 200, 12, -1, FALSE, '`Title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Title->Sortable = TRUE; // Allow sort
		$this->Title->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['Title'] = &$this->Title;

		// Surname
		$this->Surname = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->GroupingFieldId = 3;
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->Surname->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['Surname'] = &$this->Surname;

		// FirstName
		$this->FirstName = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->GroupingFieldId = 4;
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->FirstName->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->MiddleName->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['MiddleName'] = &$this->MiddleName;

		// Sex
		$this->Sex = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_Sex', 'Sex', '`Sex`', '`Sex`', 200, 6, -1, FALSE, '`Sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sex->Nullable = FALSE; // NOT NULL field
		$this->Sex->Required = TRUE; // Required field
		$this->Sex->Sortable = TRUE; // Allow sort
		$this->Sex->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['Sex'] = &$this->Sex;

		// NRC
		$this->NRC = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_NRC', 'NRC', '`NRC`', '`NRC`', 200, 13, -1, FALSE, '`NRC`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NRC->Nullable = FALSE; // NOT NULL field
		$this->NRC->Required = TRUE; // Required field
		$this->NRC->Sortable = TRUE; // Allow sort
		$this->NRC->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['NRC'] = &$this->NRC;

		// SalaryScale
		$this->SalaryScale = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_SalaryScale', 'SalaryScale', '`SalaryScale`', '`SalaryScale`', 200, 10, -1, FALSE, '`SalaryScale`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SalaryScale->Nullable = FALSE; // NOT NULL field
		$this->SalaryScale->Required = TRUE; // Required field
		$this->SalaryScale->Sortable = TRUE; // Allow sort
		$this->SalaryScale->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['SalaryScale'] = &$this->SalaryScale;

		// Division
		$this->Division = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_Division', 'Division', '`Division`', '`Division`', 16, 3, -1, FALSE, '`Division`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Division->Nullable = FALSE; // NOT NULL field
		$this->Division->Sortable = TRUE; // Allow sort
		$this->Division->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->Division->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['Division'] = &$this->Division;

		// PositionName
		$this->PositionName = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_PositionName', 'PositionName', '`PositionName`', '`PositionName`', 200, 255, -1, FALSE, '`PositionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PositionName->GroupingFieldId = 5;
		$this->PositionName->Nullable = FALSE; // NOT NULL field
		$this->PositionName->Required = TRUE; // Required field
		$this->PositionName->Sortable = TRUE; // Allow sort
		$this->PositionName->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['PositionName'] = &$this->PositionName;

		// PaymentMethod
		$this->PaymentMethod = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_PaymentMethod', 'PaymentMethod', '`PaymentMethod`', '`PaymentMethod`', 200, 1, -1, FALSE, '`PaymentMethod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PaymentMethod->Sortable = TRUE; // Allow sort
		$this->PaymentMethod->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['PaymentMethod'] = &$this->PaymentMethod;

		// BankBranchCode
		$this->BankBranchCode = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_BankBranchCode', 'BankBranchCode', '`BankBranchCode`', '`BankBranchCode`', 200, 8, -1, FALSE, '`BankBranchCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BankBranchCode->Sortable = TRUE; // Allow sort
		$this->BankBranchCode->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['BankBranchCode'] = &$this->BankBranchCode;

		// BankAccountNo
		$this->BankAccountNo = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_BankAccountNo', 'BankAccountNo', '`BankAccountNo`', '`BankAccountNo`', 200, 13, -1, FALSE, '`BankAccountNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BankAccountNo->Sortable = TRUE; // Allow sort
		$this->BankAccountNo->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['BankAccountNo'] = &$this->BankAccountNo;

		// PaidPosition
		$this->PaidPosition = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_PaidPosition', 'PaidPosition', '`PaidPosition`', '`PaidPosition`', 200, 255, -1, FALSE, '`PaidPosition`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PaidPosition->Sortable = TRUE; // Allow sort
		$this->PaidPosition->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['PaidPosition'] = &$this->PaidPosition;

		// PayrollPeriod
		$this->PayrollPeriod = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_PayrollPeriod', 'PayrollPeriod', '`PayrollPeriod`', '`PayrollPeriod`', 3, 11, -1, FALSE, '`PayrollPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollPeriod->Nullable = FALSE; // NOT NULL field
		$this->PayrollPeriod->Required = TRUE; // Required field
		$this->PayrollPeriod->Sortable = TRUE; // Allow sort
		$this->PayrollPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->PayrollPeriod->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['PayrollPeriod'] = &$this->PayrollPeriod;

		// AmtType
		$this->AmtType = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_AmtType', 'AmtType', '`AmtType`', '`AmtType`', 200, 6, -1, FALSE, '`AmtType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmtType->Nullable = FALSE; // NOT NULL field
		$this->AmtType->Required = TRUE; // Required field
		$this->AmtType->Sortable = TRUE; // Allow sort
		$this->AmtType->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['AmtType'] = &$this->AmtType;

		// PCode
		$this->PCode = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_PCode', 'PCode', '`PCode`', '`PCode`', 200, 13, -1, FALSE, '`PCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PCode->Nullable = FALSE; // NOT NULL field
		$this->PCode->Required = TRUE; // Required field
		$this->PCode->Sortable = TRUE; // Allow sort
		$this->PCode->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['PCode'] = &$this->PCode;

		// Amount
		$this->Amount = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_Amount', 'Amount', '`Amount`', '`Amount`', 5, 23, -1, FALSE, '`Amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Amount->Sortable = TRUE; // Allow sort
		$this->Amount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->Amount->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['Amount'] = &$this->Amount;

		// Period
		$this->Period = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_Period', 'Period', '`Period`', '`Period`', 200, 11, -1, FALSE, '`Period`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Period->GroupingFieldId = 6;
		$this->Period->Nullable = FALSE; // NOT NULL field
		$this->Period->Required = TRUE; // Required field
		$this->Period->Sortable = TRUE; // Allow sort
		$this->Period->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['Period'] = &$this->Period;

		// PayCode
		$this->PayCode = new ReportField('Monthly_Payroll_Summary_Report', 'Monthly Payroll Summary Report', 'x_PayCode', 'PayCode', '`PayCode`', '`PayCode`', 200, 4, -1, FALSE, '`PayCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayCode->Nullable = FALSE; // NOT NULL field
		$this->PayCode->Required = TRUE; // Required field
		$this->PayCode->Sortable = TRUE; // Allow sort
		$this->PayCode->SourceTableVar = '_monthly_payroll_summary_view';
		$this->fields['PayCode'] = &$this->PayCode;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() != "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql != "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql != "") {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Table Level Group SQL
	private $_sqlFirstGroupField = "";
	private $_sqlSelectGroup = "";
	private $_sqlOrderByGroup = "";

	// First Group Field
	public function getSqlFirstGroupField($alias = FALSE)
	{
		if ($this->_sqlFirstGroupField != "")
			return $this->_sqlFirstGroupField;
		$firstGroupField = &$this->DepartmentName;
		$expr = $firstGroupField->Expression;
		if ($firstGroupField->GroupSql != "") {
			$expr = str_replace("%s", $firstGroupField->Expression, $firstGroupField->GroupSql);
			if ($alias)
				$expr .= " AS " . QuotedName($firstGroupField->getGroupName(), $this->Dbid);
		}
		return $expr;
	}
	public function setSqlFirstGroupField($v)
	{
		$this->_sqlFirstGroupField = $v;
	}

	// Select Group
	public function getSqlSelectGroup()
	{
		return ($this->_sqlSelectGroup != "") ? $this->_sqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField(TRUE) . " FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectGroup($v)
	{
		$this->_sqlSelectGroup = $v;
	}

	// Order By Group
	public function getSqlOrderByGroup()
	{
		if ($this->_sqlOrderByGroup != "")
			return $this->_sqlOrderByGroup;
		return $this->getSqlFirstGroupField() . " ASC";
	}
	public function setSqlOrderByGroup($v)
	{
		$this->_sqlOrderByGroup = $v;
	}

	// Crosstab properties
	private $_sqlSelectAggregate = "";
	private $_sqlGroupByAggregate = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT {DistinctColumnFields} FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Group By Aggregate
	public function getSqlGroupByAggregate()
	{
		return ($this->_sqlGroupByAggregate != "") ? $this->_sqlGroupByAggregate : "";
	}
	public function setSqlGroupByAggregate($v)
	{
		$this->_sqlGroupByAggregate = $v;
	}

	// Table level SQL
	private $_columnField = "";
	private $_columnDateType = "";
	private $_columnCaptions = "";
	private $_columnNames = "";
	private $_columnValues = "";
	private $_sqlDistinctSelect = "";
	private $_sqlDistinctWhere = "";
	private $_sqlDistinctOrderBy = "";
	public $Columns;
	public $ColumnCount;
	public $Col;
	public $DistinctColumnFields = "";
	private $_columnLoaded = FALSE;

	// Column field
	public function getColumnField()
	{
		return ($this->_columnField != "") ? $this->_columnField : "`PCode`";
	}
	public function setColumnField($v)
	{
		$this->_columnField = $v;
	}

	// Column date type
	public function getColumnDateType()
	{
		return ($this->_columnDateType != "") ? $this->_columnDateType : "";
	}
	public function setColumnDateType($v)
	{
		$this->_columnDateType = $v;
	}

	// Column captions
	public function getColumnCaptions()
	{
		global $Language;
		return ($this->_columnCaptions != "") ? $this->_columnCaptions : "";
	}
	public function setColumnCaptions($v)
	{
		$this->_columnCaptions = $v;
	}

	// Column names
	public function getColumnNames()
	{
		return ($this->_columnNames != "") ? $this->_columnNames : "";
	}
	public function setColumnNames($v)
	{
		$this->_columnNames = $v;
	}

	// Column values
	public function getColumnValues()
	{
		return ($this->_columnValues != "") ? $this->_columnValues : "";
	}
	public function setColumnValues($v)
	{
		$this->_columnValues = $v;
	}

	// Select Distinct
	public function getSqlDistinctSelect()
	{
		return ($this->_sqlDistinctSelect != "") ? $this->_sqlDistinctSelect : "SELECT DISTINCT `PCode` FROM `monthly_payroll_summary_view`";
	}
	public function setSqlDistinctSelect($v)
	{
		$this->_sqlDistinctSelect = $v;
	}

	// Distinct Where
	public function getSqlDistinctWhere()
	{
		$where = ($this->_sqlDistinctWhere != "") ? $this->_sqlDistinctWhere : "";
		$filter = "";
		AddFilter($where, $filter);
		return $where;
	}
	public function setSqlDistinctWhere($v)
	{
		$this->_sqlDistinctWhere = $v;
	}

	// Distinct Order By
	public function getSqlDistinctOrderBy()
	{
		return ($this->_sqlDistinctOrderBy != "") ? $this->_sqlDistinctOrderBy : "`PCode` ASC";
	}
	public function setSqlDistinctOrderBy($v)
	{
		$this->_sqlDistinctOrderBy = $v;
	}

	// Load column values
	public function loadColumnValues($filter = "")
	{
		global $Language;

		// Data already loaded, return
		if ($this->_columnLoaded)
			return;
		$conn = $this->getConnection();

		// Build SQL
		$sql = BuildReportSql($this->getSqlDistinctSelect(), $this->getSqlDistinctWhere(), "", "", $this->getSqlDistinctOrderBy(), $filter, "");

		// Load recordset
		$rscol = $conn->execute($sql);

		// Get distinct column count
		$this->ColumnCount = ($rscol) ? $rscol->recordCount() : 0;

/* Uncomment to show phrase
		if ($this->ColumnCount == 0) {
			if ($rscol)
				$rscol->close();
			echo "<p>" . $Language->phrase("NoDistinctColVals") . $sql . "</p>";
			exit();
		}
*/
		$this->Columns = Init2DArray($this->ColumnCount + 1, 7, NULL);
		$colcnt = 0;
		while ($rscol && !$rscol->EOF) {
			if ($rscol->fields[0] === NULL) {
				$wrkValue = Config("NULL_VALUE");
				$wrkCaption = $Language->phrase("NullLabel");
			} elseif (strval($rscol->fields[0]) == "") {
				$wrkValue = EMPTY_VALUE;
				$wrkCaption = $Language->phrase("EmptyLabel");
			} else {
				$wrkValue = $rscol->fields[0];
				$wrkCaption = $rscol->fields[0];
			}
			$colcnt++;
			$this->Columns[$colcnt] = new CrosstabColumn($wrkValue, $wrkCaption, TRUE);
			$rscol->moveNext();
		}
		if ($rscol)
			$rscol->close();

		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of distinct values

		$groupCount = 6;
		$this->SummaryFields[0] = new SummaryField('x_Amount', 'Amount', '`Amount`', 'SUM');
		$this->SummaryFields[0]->SummaryCaption = $Language->phrase("RptSum");
		$this->SummaryFields[0]->SummaryValues = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[0]->SummaryValueCounts = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[0]->SummaryInitValue = 0;

		// Update crosstab SQL
		$sqlFlds = "";
		$cnt = count($this->SummaryFields);
		for ($is = 0; $is < $cnt; $is++) {
			$smry = &$this->SummaryFields[$is];
			for ($i = 1; $i <= $this->ColumnCount; $i++) {
				$fld = CrosstabFieldExpression($smry->SummaryType, $smry->Expression, $this->getColumnField(), $this->getColumnDateType(), $this->Columns[$i]->Value, "'", "C" . $is . $i, $this->Dbid);
				if ($sqlFlds != "")
					$sqlFlds .= ", ";
				$sqlFlds .= $fld;
			}
		}
		$this->DistinctColumnFields = $sqlFlds ?: "NULL"; // In case ColumnCount = 0
		$this->_columnLoaded = TRUE;
	}

	// Render for lookup
	public function renderLookup()
	{
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`monthly_payroll_summary_view`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT `DepartmentName`, `EmployeeID`, `Surname`, `FirstName`, `PositionName`, `Period`, {DistinctColumnFields} FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "`DepartmentName`, `EmployeeID`, `Surname`, `FirstName`, `PositionName`, `Period`";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "")
			return $Language->phrase("View");
		elseif ($pageName == "")
			return $Language->phrase("Edit");
		elseif ($pageName == "")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "?" . $this->getUrlParm($parm);
		else
			$url = "";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		global $DashboardReport;
		if ($this->CurrentAction || $this->isExport() ||
			$this->DrillDown || $DashboardReport ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>