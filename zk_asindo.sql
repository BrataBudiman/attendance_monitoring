USE [zk_asindo]
GO
/****** Object:  Table [dbo].[ACGroup]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ACGroup](
	[GroupID] [smallint] NOT NULL,
	[Name] [varchar](30) NULL,
	[TimeZone1] [smallint] NULL,
	[TimeZone2] [smallint] NULL,
	[TimeZone3] [smallint] NULL,
	[holidayvaild] [bit] NULL,
	[verifystyle] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[GroupID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ACTimeZones]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ACTimeZones](
	[TimeZoneID] [smallint] NOT NULL,
	[Name] [varchar](30) NULL,
	[SunStart] [datetime] NULL,
	[SunEnd] [datetime] NULL,
	[MonStart] [datetime] NULL,
	[MonEnd] [datetime] NULL,
	[TuesStart] [datetime] NULL,
	[TuesEnd] [datetime] NULL,
	[WedStart] [datetime] NULL,
	[WedEnd] [datetime] NULL,
	[ThursStart] [datetime] NULL,
	[ThursEnd] [datetime] NULL,
	[FriStart] [datetime] NULL,
	[FriEnd] [datetime] NULL,
	[SatStart] [datetime] NULL,
	[SatEnd] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[TimeZoneID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ACUnlockComb]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ACUnlockComb](
	[UnlockCombID] [smallint] NOT NULL,
	[Name] [varchar](30) NULL,
	[Group01] [smallint] NULL,
	[Group02] [smallint] NULL,
	[Group03] [smallint] NULL,
	[Group04] [smallint] NULL,
	[Group05] [smallint] NULL,
PRIMARY KEY CLUSTERED 
(
	[UnlockCombID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[AlarmLog]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[AlarmLog](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Operator] [varchar](20) NULL,
	[EnrollNumber] [varchar](30) NULL,
	[LogTime] [datetime] NULL,
	[MachineAlias] [varchar](20) NULL,
	[AlarmType] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[AttParam]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[AttParam](
	[PARANAME] [varchar](20) NOT NULL,
	[PARATYPE] [varchar](2) NULL,
	[PARAVALUE] [varchar](100) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[PARANAME] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[AuditedExc]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[AuditedExc](
	[AEID] [int] IDENTITY(1,1) NOT NULL,
	[UserId] [int] NULL,
	[CheckTime] [datetime] NOT NULL,
	[NewExcID] [int] NULL,
	[IsLeave] [smallint] NULL,
	[UName] [varchar](20) NULL,
	[UTime] [datetime] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[AEID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[AUTHDEVICE]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[AUTHDEVICE](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[USERID] [int] NOT NULL,
	[MachineID] [int] NOT NULL,
 CONSTRAINT [AUTHKEY] PRIMARY KEY CLUSTERED 
(
	[USERID] ASC,
	[MachineID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CHECKEXACT]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CHECKEXACT](
	[EXACTID] [int] IDENTITY(1,1) NOT NULL,
	[USERID] [int] NULL,
	[CHECKTIME] [datetime] NULL,
	[CHECKTYPE] [varchar](2) NULL,
	[ISADD] [smallint] NULL,
	[YUYIN] [varchar](25) NULL,
	[ISMODIFY] [smallint] NULL,
	[ISDELETE] [smallint] NULL,
	[INCOUNT] [smallint] NULL,
	[ISCOUNT] [smallint] NULL,
	[MODIFYBY] [varchar](20) NULL,
	[DATE] [datetime] NULL,
 CONSTRAINT [EXACTID] PRIMARY KEY CLUSTERED 
(
	[EXACTID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CHECKINOUT]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CHECKINOUT](
	[USERID] [int] NOT NULL,
	[CHECKTIME] [datetime] NOT NULL,
	[CHECKTYPE] [varchar](1) NULL,
	[VERIFYCODE] [int] NULL,
	[SENSORID] [varchar](5) NULL,
	[Memoinfo] [varchar](30) NULL,
	[WorkCode] [varchar](24) NULL,
	[sn] [varchar](20) NULL,
	[UserExtFmt] [smallint] NULL,
 CONSTRAINT [USERCHECKTIME] PRIMARY KEY CLUSTERED 
(
	[USERID] ASC,
	[CHECKTIME] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DEPARTMENTS]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DEPARTMENTS](
	[DEPTID] [int] IDENTITY(1,1) NOT NULL,
	[DEPTNAME] [varchar](30) NULL,
	[SUPDEPTID] [int] NOT NULL,
	[InheritParentSch] [smallint] NULL,
	[InheritDeptSch] [smallint] NULL,
	[InheritDeptSchClass] [smallint] NULL,
	[AutoSchPlan] [smallint] NULL,
	[InLate] [smallint] NULL,
	[OutEarly] [smallint] NULL,
	[InheritDeptRule] [smallint] NULL,
	[MinAutoSchInterval] [int] NULL,
	[RegisterOT] [smallint] NULL,
	[DefaultSchId] [int] NOT NULL,
	[ATT] [smallint] NULL,
	[Holiday] [smallint] NULL,
	[OverTime] [smallint] NULL,
 CONSTRAINT [DEPTID] PRIMARY KEY CLUSTERED 
(
	[DEPTID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DeptUsedSchs]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DeptUsedSchs](
	[DeptId] [int] NOT NULL,
	[SchId] [int] NOT NULL,
 CONSTRAINT [DEPT_USED_SCH] PRIMARY KEY CLUSTERED 
(
	[DeptId] ASC,
	[SchId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[EmOpLog]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[EmOpLog](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[USERID] [int] NOT NULL,
	[OperateTime] [datetime] NOT NULL,
	[manipulationID] [int] NULL,
	[Params1] [int] NULL,
	[Params2] [int] NULL,
	[Params3] [int] NULL,
	[Params4] [int] NULL,
	[SensorId] [varchar](5) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[EXCNOTES]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[EXCNOTES](
	[USERID] [int] NULL,
	[ATTDATE] [datetime] NULL,
	[NOTES] [varchar](200) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[FaceTemp]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[FaceTemp](
	[TEMPLATEID] [int] IDENTITY(1,1) NOT NULL,
	[USERNO] [varchar](24) NULL,
	[SIZE] [int] NULL,
	[pin] [int] NULL,
	[FACEID] [int] NULL,
	[VALID] [int] NULL,
	[RESERVE] [int] NULL,
	[ACTIVETIME] [int] NULL,
	[VFCOUNT] [int] NULL,
	[TEMPLATE] [image] NULL,
	[UserID] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[TEMPLATEID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[HOLIDAYS]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[HOLIDAYS](
	[HOLIDAYID] [int] IDENTITY(1,1) NOT NULL,
	[HOLIDAYNAME] [varchar](20) NULL,
	[HOLIDAYYEAR] [smallint] NULL,
	[HOLIDAYMONTH] [smallint] NULL,
	[HOLIDAYDAY] [smallint] NULL,
	[STARTTIME] [datetime] NULL,
	[DURATION] [smallint] NULL,
	[HOLIDAYTYPE] [smallint] NULL,
	[XINBIE] [varchar](4) NULL,
	[MINZU] [varchar](50) NULL,
	[DeptID] [smallint] NULL,
	[timezone] [int] NULL,
 CONSTRAINT [HOLID] PRIMARY KEY CLUSTERED 
(
	[HOLIDAYID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[LeaveClass]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[LeaveClass](
	[LeaveId] [int] IDENTITY(1,1) NOT NULL,
	[LeaveName] [varchar](20) NOT NULL,
	[MinUnit] [float] NOT NULL,
	[Unit] [smallint] NOT NULL,
	[RemaindProc] [smallint] NOT NULL,
	[RemaindCount] [smallint] NOT NULL,
	[ReportSymbol] [varchar](4) NOT NULL,
	[Deduct] [float] NOT NULL,
	[Color] [int] NOT NULL,
	[Classify] [smallint] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[LeaveId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[LeaveClass1]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[LeaveClass1](
	[LeaveId] [int] IDENTITY(999,1) NOT NULL,
	[LeaveName] [varchar](20) NOT NULL,
	[MinUnit] [float] NOT NULL,
	[Unit] [smallint] NOT NULL,
	[RemaindProc] [smallint] NOT NULL,
	[RemaindCount] [smallint] NOT NULL,
	[ReportSymbol] [varchar](4) NOT NULL,
	[Deduct] [float] NOT NULL,
	[LeaveType] [smallint] NOT NULL,
	[Color] [int] NOT NULL,
	[Classify] [smallint] NOT NULL,
	[Calc] [text] NULL,
PRIMARY KEY CLUSTERED 
(
	[LeaveId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Machines]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Machines](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[MachineAlias] [varchar](20) NOT NULL,
	[ConnectType] [int] NOT NULL,
	[IP] [varchar](20) NULL,
	[SerialPort] [int] NULL,
	[Port] [int] NULL,
	[Baudrate] [int] NULL,
	[MachineNumber] [int] NOT NULL,
	[IsHost] [bit] NULL,
	[Enabled] [bit] NULL,
	[CommPassword] [varchar](12) NULL,
	[UILanguage] [smallint] NULL,
	[DateFormat] [smallint] NULL,
	[InOutRecordWarn] [smallint] NULL,
	[Idle] [smallint] NULL,
	[Voice] [smallint] NULL,
	[managercount] [smallint] NULL,
	[usercount] [smallint] NULL,
	[fingercount] [smallint] NULL,
	[SecretCount] [smallint] NULL,
	[FirmwareVersion] [varchar](20) NULL,
	[ProductType] [varchar](20) NULL,
	[LockControl] [smallint] NULL,
	[Purpose] [smallint] NULL,
	[ProduceKind] [int] NULL,
	[sn] [varchar](20) NULL,
	[PhotoStamp] [varchar](20) NULL,
	[IsIfChangeConfigServer2] [int] NULL,
	[IsAndroid] [varchar](1) NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[NUM_RUN]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[NUM_RUN](
	[NUM_RUNID] [int] IDENTITY(1,1) NOT NULL,
	[OLDID] [int] NULL,
	[NAME] [varchar](30) NOT NULL,
	[STARTDATE] [datetime] NULL,
	[ENDDATE] [datetime] NULL,
	[CYLE] [smallint] NULL,
	[UNITS] [smallint] NULL,
 CONSTRAINT [NUMID] PRIMARY KEY CLUSTERED 
(
	[NUM_RUNID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[NUM_RUN_DEIL]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[NUM_RUN_DEIL](
	[NUM_RUNID] [smallint] NOT NULL,
	[STARTTIME] [datetime] NOT NULL,
	[ENDTIME] [datetime] NULL,
	[SDAYS] [smallint] NOT NULL,
	[EDAYS] [smallint] NULL,
	[SCHCLASSID] [int] NULL,
	[OverTime] [int] NULL,
 CONSTRAINT [NUMID2] PRIMARY KEY CLUSTERED 
(
	[NUM_RUNID] ASC,
	[SDAYS] ASC,
	[STARTTIME] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReportItem]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReportItem](
	[RIID] [int] IDENTITY(1,1) NOT NULL,
	[RIIndex] [int] NULL,
	[ShowIt] [smallint] NULL,
	[RIName] [varchar](12) NULL,
	[UnitName] [varchar](6) NULL,
	[Formula] [image] NOT NULL,
	[CalcBySchClass] [smallint] NULL,
	[StatisticMethod] [smallint] NULL,
	[CalcLast] [smallint] NULL,
	[Notes] [image] NULL,
PRIMARY KEY CLUSTERED 
(
	[RIID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SchClass]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SchClass](
	[schClassid] [int] IDENTITY(1,1) NOT NULL,
	[schName] [varchar](20) NOT NULL,
	[StartTime] [datetime] NOT NULL,
	[EndTime] [datetime] NOT NULL,
	[LateMinutes] [int] NULL,
	[EarlyMinutes] [int] NULL,
	[CheckIn] [int] NULL,
	[CheckOut] [int] NULL,
	[CheckInTime1] [datetime] NULL,
	[CheckInTime2] [datetime] NULL,
	[CheckOutTime1] [datetime] NULL,
	[CheckOutTime2] [datetime] NULL,
	[Color] [int] NULL,
	[AutoBind] [smallint] NULL,
	[WorkDay] [float] NULL,
	[SensorID] [varchar](5) NULL,
	[WorkMins] [float] NULL,
PRIMARY KEY CLUSTERED 
(
	[schClassid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SECURITYDETAILS]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SECURITYDETAILS](
	[SECURITYDETAILID] [int] IDENTITY(1,1) NOT NULL,
	[USERID] [int] NULL,
	[DEPTID] [smallint] NULL,
	[SCHEDULE] [smallint] NULL,
	[USERINFO] [smallint] NULL,
	[ENROLLFINGERS] [smallint] NULL,
	[REPORTVIEW] [smallint] NULL,
	[REPORT] [varchar](10) NULL,
	[ReadOnly] [bit] NULL,
	[FullControl] [bit] NULL,
 CONSTRAINT [NAMEID2] PRIMARY KEY CLUSTERED 
(
	[SECURITYDETAILID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ServerLog]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ServerLog](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[EVENT] [varchar](30) NOT NULL,
	[USERID] [int] NOT NULL,
	[EnrollNumber] [varchar](30) NULL,
	[parameter] [smallint] NULL,
	[EVENTTIME] [datetime] NOT NULL,
	[SENSORID] [varchar](5) NULL,
	[OPERATOR] [varchar](20) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[sftp_acc]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[sftp_acc](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[conn_name] [varchar](50) NULL,
	[hostname] [varchar](50) NULL,
	[username] [varchar](50) NULL,
	[password] [varchar](100) NULL,
	[port] [int] NULL,
	[flag] [int] NULL,
 CONSTRAINT [PK_sftp_acc] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SHIFT]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SHIFT](
	[SHIFTID] [int] IDENTITY(1,1) NOT NULL,
	[NAME] [varchar](20) NULL,
	[USHIFTID] [int] NULL,
	[STARTDATE] [datetime] NOT NULL,
	[ENDDATE] [datetime] NULL,
	[RUNNUM] [smallint] NULL,
	[SCH1] [int] NULL,
	[SCH2] [int] NULL,
	[SCH3] [int] NULL,
	[SCH4] [int] NULL,
	[SCH5] [int] NULL,
	[SCH6] [int] NULL,
	[SCH7] [int] NULL,
	[SCH8] [int] NULL,
	[SCH9] [int] NULL,
	[SCH10] [int] NULL,
	[SCH11] [int] NULL,
	[SCH12] [int] NULL,
	[CYCLE] [smallint] NULL,
	[UNITS] [smallint] NULL,
 CONSTRAINT [SHIFTS] PRIMARY KEY CLUSTERED 
(
	[SHIFTID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SystemLog]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SystemLog](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Operator] [varchar](20) NULL,
	[LogTime] [datetime] NULL,
	[MachineAlias] [varchar](20) NULL,
	[LogTag] [smallint] NULL,
	[LogDescr] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TBKEY]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TBKEY](
	[PreName] [varchar](12) NULL,
	[ONEKEY] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TBSMSALLOT]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TBSMSALLOT](
	[REFERENCE] [int] NOT NULL,
	[SMSREF] [int] NOT NULL,
	[USERREF] [int] NOT NULL,
	[GENTM] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[REFERENCE] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TBSMSINFO]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TBSMSINFO](
	[REFERENCE] [int] NOT NULL,
	[SMSID] [varchar](16) NOT NULL,
	[SMSINDEX] [int] NOT NULL,
	[SMSTYPE] [int] NULL,
	[SMSCONTENT] [text] NULL,
	[SMSSTARTTM] [varchar](32) NULL,
	[SMSTMLENG] [int] NULL,
	[GENTM] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[REFERENCE] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TEMPLATE]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TEMPLATE](
	[TEMPLATEID] [int] IDENTITY(1,1) NOT NULL,
	[USERID] [int] NOT NULL,
	[FINGERID] [int] NOT NULL,
	[TEMPLATE] [image] NOT NULL,
	[TEMPLATE2] [image] NULL,
	[TEMPLATE3] [image] NULL,
	[BITMAPPICTURE] [image] NULL,
	[BITMAPPICTURE2] [image] NULL,
	[BITMAPPICTURE3] [image] NULL,
	[BITMAPPICTURE4] [image] NULL,
	[USETYPE] [smallint] NULL,
	[EMACHINENUM] [varchar](3) NULL,
	[TEMPLATE1] [image] NULL,
	[Flag] [smallint] NULL,
	[DivisionFP] [smallint] NULL,
	[TEMPLATE4] [image] NULL,
 CONSTRAINT [TEMPLATED] PRIMARY KEY CLUSTERED 
(
	[TEMPLATEID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[user_data_upload]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[user_data_upload](
	[id_trx] [int] IDENTITY(1,1) NOT NULL,
	[trx_code] [varchar](50) NULL,
	[EmpNo] [varchar](25) NULL,
	[Attend_Time] [varchar](50) NULL,
	[Status] [varchar](1) NULL,
	[Pos] [varchar](24) NULL,
	[MachineCode] [varchar](20) NULL,
	[transfer_by] [varchar](50) NULL,
	[transfer_at] [varchar](50) NULL,
	[file_name] [varchar](100) NULL,
	[flag] [varchar](1) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[user_files_upload]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[user_files_upload](
	[id_trx] [int] IDENTITY(1,1) NOT NULL,
	[name_file] [varchar](100) NULL,
	[start_from] [varchar](50) NULL,
	[start_to] [varchar](50) NULL,
	[data_sum] [int] NULL,
	[status] [int] NULL,
	[timestamps] [varchar](50) NULL,
	[transfer_by] [varchar](100) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[USER_OF_RUN]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[USER_OF_RUN](
	[USERID] [int] NOT NULL,
	[NUM_OF_RUN_ID] [int] NOT NULL,
	[STARTDATE] [datetime] NOT NULL,
	[ENDDATE] [datetime] NOT NULL,
	[ISNOTOF_RUN] [int] NULL,
	[ORDER_RUN] [int] NULL,
 CONSTRAINT [USER_ST_NUM] PRIMARY KEY CLUSTERED 
(
	[USERID] ASC,
	[NUM_OF_RUN_ID] ASC,
	[STARTDATE] ASC,
	[ENDDATE] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[USER_SPEDAY]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[USER_SPEDAY](
	[USERID] [int] NOT NULL,
	[STARTSPECDAY] [datetime] NOT NULL,
	[ENDSPECDAY] [datetime] NULL,
	[DATEID] [smallint] NOT NULL,
	[YUANYING] [varchar](200) NULL,
	[DATE] [datetime] NULL,
 CONSTRAINT [USER_SEP] PRIMARY KEY CLUSTERED 
(
	[USERID] ASC,
	[STARTSPECDAY] ASC,
	[DATEID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[USER_TEMP_SCH]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[USER_TEMP_SCH](
	[USERID] [int] NOT NULL,
	[COMETIME] [datetime] NOT NULL,
	[LEAVETIME] [datetime] NOT NULL,
	[OVERTIME] [int] NOT NULL,
	[TYPE] [smallint] NULL,
	[FLAG] [smallint] NULL,
	[SCHCLASSID] [int] NULL,
 CONSTRAINT [USER_TEMP] PRIMARY KEY CLUSTERED 
(
	[USERID] ASC,
	[COMETIME] ASC,
	[LEAVETIME] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UserACMachines]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserACMachines](
	[UserID] [int] NOT NULL,
	[Deviceid] [int] NOT NULL,
 CONSTRAINT [UserAC_Machines] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC,
	[Deviceid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UserACPrivilege]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserACPrivilege](
	[UserID] [int] NOT NULL,
	[DeviceID] [int] NOT NULL,
	[ACGroupID] [int] NULL,
	[IsUseGroup] [bit] NULL,
	[TimeZone1] [int] NULL,
	[TimeZone2] [int] NULL,
	[TimeZone3] [int] NULL,
	[verifystyle] [int] NULL,
 CONSTRAINT [pk_privilege] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC,
	[DeviceID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[USERINFO]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[USERINFO](
	[USERID] [int] IDENTITY(1,1) NOT NULL,
	[BADGENUMBER] [varchar](24) NOT NULL,
	[SSN] [varchar](20) NULL,
	[NAME] [varchar](40) NULL,
	[GENDER] [varchar](8) NULL,
	[TITLE] [varchar](20) NULL,
	[PAGER] [varchar](20) NULL,
	[BIRTHDAY] [datetime] NULL,
	[HIREDDAY] [datetime] NULL,
	[STREET] [varchar](80) NULL,
	[CITY] [varchar](2) NULL,
	[STATE] [varchar](2) NULL,
	[ZIP] [varchar](12) NULL,
	[OPHONE] [varchar](20) NULL,
	[FPHONE] [varchar](20) NULL,
	[VERIFICATIONMETHOD] [smallint] NULL,
	[DEFAULTDEPTID] [smallint] NULL,
	[SECURITYFLAGS] [smallint] NULL,
	[ATT] [smallint] NOT NULL,
	[INLATE] [smallint] NOT NULL,
	[OUTEARLY] [smallint] NOT NULL,
	[OVERTIME] [smallint] NOT NULL,
	[SEP] [smallint] NOT NULL,
	[HOLIDAY] [smallint] NOT NULL,
	[MINZU] [varchar](8) NULL,
	[PASSWORD] [varchar](50) NULL,
	[LUNCHDURATION] [smallint] NOT NULL,
	[MVerifyPass] [varchar](10) NULL,
	[PHOTO] [image] NULL,
	[Notes] [image] NULL,
	[privilege] [int] NULL,
	[InheritDeptSch] [smallint] NULL,
	[InheritDeptSchClass] [smallint] NULL,
	[AutoSchPlan] [smallint] NULL,
	[MinAutoSchInterval] [int] NULL,
	[RegisterOT] [smallint] NULL,
	[InheritDeptRule] [smallint] NULL,
	[EMPRIVILEGE] [smallint] NULL,
	[CardNo] [varchar](20) NULL,
	[FaceGroup] [int] NULL,
	[AccGroup] [int] NULL,
	[UseAccGroupTZ] [int] NULL,
	[VerifyCode] [int] NULL,
	[Expires] [int] NULL,
	[ValidCount] [int] NULL,
	[ValidTimeBegin] [datetime] NULL,
	[ValidTimeEnd] [datetime] NULL,
	[TimeZone1] [int] NULL,
	[TimeZone2] [int] NULL,
	[TimeZone3] [int] NULL,
	[IDCardNo] [varchar](18) NULL,
	[IDCardValidTime] [varchar](21) NULL,
 CONSTRAINT [USERIDS] PRIMARY KEY CLUSTERED 
(
	[USERID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[username] [varchar](50) NULL,
	[password] [varchar](100) NULL,
	[email] [varchar](50) NULL,
	[level_user] [int] NULL,
	[status_user] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UsersMachines]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UsersMachines](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[USERID] [int] NOT NULL,
	[DEVICEID] [int] NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UserUpdates]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserUpdates](
	[UpdateId] [int] IDENTITY(1,1) NOT NULL,
	[BadgeNumber] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[UpdateId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UserUsedSClasses]    Script Date: 12/12/2019 10:53:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserUsedSClasses](
	[UserId] [int] NOT NULL,
	[SchId] [int] NOT NULL,
 CONSTRAINT [USER_USED_SCL] PRIMARY KEY CLUSTERED 
(
	[UserId] ASC,
	[SchId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[ACGroup] ADD  DEFAULT ((0)) FOR [TimeZone1]
GO
ALTER TABLE [dbo].[ACGroup] ADD  DEFAULT ((0)) FOR [TimeZone2]
GO
ALTER TABLE [dbo].[ACGroup] ADD  DEFAULT ((0)) FOR [TimeZone3]
GO
ALTER TABLE [dbo].[AlarmLog] ADD  DEFAULT (getdate()) FOR [LogTime]
GO
ALTER TABLE [dbo].[CHECKEXACT] ADD  DEFAULT ((0)) FOR [USERID]
GO
ALTER TABLE [dbo].[CHECKEXACT] ADD  DEFAULT ((0)) FOR [CHECKTIME]
GO
ALTER TABLE [dbo].[CHECKEXACT] ADD  DEFAULT ((0)) FOR [CHECKTYPE]
GO
ALTER TABLE [dbo].[CHECKEXACT] ADD  DEFAULT ((0)) FOR [ISADD]
GO
ALTER TABLE [dbo].[CHECKEXACT] ADD  DEFAULT ((0)) FOR [ISMODIFY]
GO
ALTER TABLE [dbo].[CHECKEXACT] ADD  DEFAULT ((0)) FOR [ISDELETE]
GO
ALTER TABLE [dbo].[CHECKEXACT] ADD  DEFAULT ((0)) FOR [INCOUNT]
GO
ALTER TABLE [dbo].[CHECKEXACT] ADD  DEFAULT ((0)) FOR [ISCOUNT]
GO
ALTER TABLE [dbo].[CHECKEXACT] ADD  DEFAULT ('Temp-Supervisor') FOR [MODIFYBY]
GO
ALTER TABLE [dbo].[CHECKINOUT] ADD  DEFAULT (getdate()) FOR [CHECKTIME]
GO
ALTER TABLE [dbo].[CHECKINOUT] ADD  DEFAULT ('I') FOR [CHECKTYPE]
GO
ALTER TABLE [dbo].[CHECKINOUT] ADD  DEFAULT ((0)) FOR [VERIFYCODE]
GO
ALTER TABLE [dbo].[CHECKINOUT] ADD  DEFAULT ((0)) FOR [WorkCode]
GO
ALTER TABLE [dbo].[CHECKINOUT] ADD  DEFAULT ((0)) FOR [UserExtFmt]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [SUPDEPTID]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [InheritParentSch]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [InheritDeptSch]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [InheritDeptSchClass]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [AutoSchPlan]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [InLate]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [OutEarly]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [InheritDeptRule]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((24)) FOR [MinAutoSchInterval]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [RegisterOT]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [DefaultSchId]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [ATT]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [Holiday]
GO
ALTER TABLE [dbo].[DEPARTMENTS] ADD  DEFAULT ((1)) FOR [OverTime]
GO
ALTER TABLE [dbo].[FaceTemp] ADD  DEFAULT ((0)) FOR [SIZE]
GO
ALTER TABLE [dbo].[FaceTemp] ADD  DEFAULT ((0)) FOR [pin]
GO
ALTER TABLE [dbo].[FaceTemp] ADD  DEFAULT ((0)) FOR [FACEID]
GO
ALTER TABLE [dbo].[FaceTemp] ADD  DEFAULT ((0)) FOR [VALID]
GO
ALTER TABLE [dbo].[FaceTemp] ADD  DEFAULT ((0)) FOR [RESERVE]
GO
ALTER TABLE [dbo].[FaceTemp] ADD  DEFAULT ((0)) FOR [ACTIVETIME]
GO
ALTER TABLE [dbo].[FaceTemp] ADD  DEFAULT ((0)) FOR [VFCOUNT]
GO
ALTER TABLE [dbo].[FaceTemp] ADD  DEFAULT ((0)) FOR [UserID]
GO
ALTER TABLE [dbo].[HOLIDAYS] ADD  DEFAULT ((1)) FOR [HOLIDAYDAY]
GO
ALTER TABLE [dbo].[HOLIDAYS] ADD  DEFAULT ((1)) FOR [DeptID]
GO
ALTER TABLE [dbo].[HOLIDAYS] ADD  DEFAULT ((0)) FOR [timezone]
GO
ALTER TABLE [dbo].[LeaveClass] ADD  DEFAULT ((1)) FOR [MinUnit]
GO
ALTER TABLE [dbo].[LeaveClass] ADD  DEFAULT ((1)) FOR [Unit]
GO
ALTER TABLE [dbo].[LeaveClass] ADD  DEFAULT ((1)) FOR [RemaindProc]
GO
ALTER TABLE [dbo].[LeaveClass] ADD  DEFAULT ((1)) FOR [RemaindCount]
GO
ALTER TABLE [dbo].[LeaveClass] ADD  DEFAULT ('-') FOR [ReportSymbol]
GO
ALTER TABLE [dbo].[LeaveClass] ADD  DEFAULT ((0)) FOR [Deduct]
GO
ALTER TABLE [dbo].[LeaveClass] ADD  DEFAULT ((0)) FOR [Color]
GO
ALTER TABLE [dbo].[LeaveClass] ADD  DEFAULT ((0)) FOR [Classify]
GO
ALTER TABLE [dbo].[LeaveClass1] ADD  DEFAULT ((1)) FOR [MinUnit]
GO
ALTER TABLE [dbo].[LeaveClass1] ADD  DEFAULT ((0)) FOR [Unit]
GO
ALTER TABLE [dbo].[LeaveClass1] ADD  DEFAULT ((2)) FOR [RemaindProc]
GO
ALTER TABLE [dbo].[LeaveClass1] ADD  DEFAULT ((1)) FOR [RemaindCount]
GO
ALTER TABLE [dbo].[LeaveClass1] ADD  DEFAULT ('-') FOR [ReportSymbol]
GO
ALTER TABLE [dbo].[LeaveClass1] ADD  DEFAULT ((0)) FOR [Deduct]
GO
ALTER TABLE [dbo].[LeaveClass1] ADD  DEFAULT ((0)) FOR [LeaveType]
GO
ALTER TABLE [dbo].[LeaveClass1] ADD  DEFAULT ((0)) FOR [Color]
GO
ALTER TABLE [dbo].[LeaveClass1] ADD  DEFAULT ((0)) FOR [Classify]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((1)) FOR [SerialPort]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((1)) FOR [Port]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((1)) FOR [MachineNumber]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [UILanguage]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [DateFormat]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [InOutRecordWarn]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [Idle]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [Voice]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [managercount]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [usercount]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [fingercount]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [SecretCount]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((-1)) FOR [LockControl]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((1)) FOR [Purpose]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((1)) FOR [ProduceKind]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((0)) FOR [PhotoStamp]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((0)) FOR [IsIfChangeConfigServer2]
GO
ALTER TABLE [dbo].[Machines] ADD  DEFAULT ((0)) FOR [IsAndroid]
GO
ALTER TABLE [dbo].[NUM_RUN] ADD  DEFAULT ((-1)) FOR [OLDID]
GO
ALTER TABLE [dbo].[NUM_RUN] ADD  DEFAULT ('1900-1-1') FOR [STARTDATE]
GO
ALTER TABLE [dbo].[NUM_RUN] ADD  DEFAULT ('2099-12-31') FOR [ENDDATE]
GO
ALTER TABLE [dbo].[NUM_RUN] ADD  DEFAULT ((1)) FOR [CYLE]
GO
ALTER TABLE [dbo].[NUM_RUN] ADD  DEFAULT ((1)) FOR [UNITS]
GO
ALTER TABLE [dbo].[NUM_RUN_DEIL] ADD  DEFAULT ((-1)) FOR [SCHCLASSID]
GO
ALTER TABLE [dbo].[SchClass] ADD  DEFAULT ((1)) FOR [CheckIn]
GO
ALTER TABLE [dbo].[SchClass] ADD  DEFAULT ((1)) FOR [CheckOut]
GO
ALTER TABLE [dbo].[SchClass] ADD  DEFAULT ((16715535)) FOR [Color]
GO
ALTER TABLE [dbo].[SchClass] ADD  DEFAULT ((1)) FOR [AutoBind]
GO
ALTER TABLE [dbo].[SchClass] ADD  DEFAULT ((1)) FOR [WorkDay]
GO
ALTER TABLE [dbo].[SchClass] ADD  DEFAULT ((0)) FOR [WorkMins]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((-1)) FOR [USHIFTID]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ('1900-1-1') FOR [STARTDATE]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ('1900-12-31') FOR [ENDDATE]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [RUNNUM]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH1]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH2]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH3]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH4]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH5]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH6]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH7]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH8]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH9]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH10]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH11]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [SCH12]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [CYCLE]
GO
ALTER TABLE [dbo].[SHIFT] ADD  DEFAULT ((0)) FOR [UNITS]
GO
ALTER TABLE [dbo].[SystemLog] ADD  DEFAULT (getdate()) FOR [LogTime]
GO
ALTER TABLE [dbo].[TEMPLATE] ADD  DEFAULT ((1)) FOR [Flag]
GO
ALTER TABLE [dbo].[TEMPLATE] ADD  DEFAULT ((0)) FOR [DivisionFP]
GO
ALTER TABLE [dbo].[USER_OF_RUN] ADD  DEFAULT ('1900-1-1') FOR [STARTDATE]
GO
ALTER TABLE [dbo].[USER_OF_RUN] ADD  DEFAULT ('2099-12-31') FOR [ENDDATE]
GO
ALTER TABLE [dbo].[USER_OF_RUN] ADD  DEFAULT ((0)) FOR [ISNOTOF_RUN]
GO
ALTER TABLE [dbo].[USER_SPEDAY] ADD  DEFAULT ('1900-1-1') FOR [STARTSPECDAY]
GO
ALTER TABLE [dbo].[USER_SPEDAY] ADD  DEFAULT ('2099-12-31') FOR [ENDSPECDAY]
GO
ALTER TABLE [dbo].[USER_SPEDAY] ADD  DEFAULT ((-1)) FOR [DATEID]
GO
ALTER TABLE [dbo].[USER_TEMP_SCH] ADD  DEFAULT ((0)) FOR [OVERTIME]
GO
ALTER TABLE [dbo].[USER_TEMP_SCH] ADD  DEFAULT ((0)) FOR [TYPE]
GO
ALTER TABLE [dbo].[USER_TEMP_SCH] ADD  DEFAULT ((1)) FOR [FLAG]
GO
ALTER TABLE [dbo].[USER_TEMP_SCH] ADD  DEFAULT ((-1)) FOR [SCHCLASSID]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [DEFAULTDEPTID]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [ATT]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [INLATE]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [OUTEARLY]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [OVERTIME]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [SEP]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [HOLIDAY]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [LUNCHDURATION]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((0)) FOR [privilege]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [InheritDeptSch]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [InheritDeptSchClass]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [AutoSchPlan]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((24)) FOR [MinAutoSchInterval]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [RegisterOT]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [InheritDeptRule]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((0)) FOR [EMPRIVILEGE]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((0)) FOR [FaceGroup]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [AccGroup]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [UseAccGroupTZ]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((0)) FOR [VerifyCode]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((0)) FOR [Expires]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((0)) FOR [ValidCount]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((1)) FOR [TimeZone1]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((0)) FOR [TimeZone2]
GO
ALTER TABLE [dbo].[USERINFO] ADD  DEFAULT ((0)) FOR [TimeZone3]
GO
