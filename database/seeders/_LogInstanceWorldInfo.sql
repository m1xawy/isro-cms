DROP TABLE [dbo].[_LogInstanceWorldInfo]
CREATE TABLE [dbo].[_LogInstanceWorldInfo](
    [WorldID] [int] NOT NULL,
    [EventTime] [datetime] NOT NULL,
    [GameWorldLayerID] [smallint] NULL,
    [CharID] [int] NOT NULL,
    [ValueCodeName128] [varchar](129) NOT NULL,
    [Value] [varchar](129) NULL
    ) ON [PRIMARY]
    GO


