DROP TABLE [dbo].[_Rigid_MagOptDesc]
CREATE TABLE [dbo].[_Rigid_MagOptDesc](
    [id] [int] NOT NULL,
    [name] [nvarchar](255) NOT NULL,
    [desc] [nvarchar](255) NOT NULL,
    [mLevel] [int] NOT NULL,
    [extension] [nvarchar](255) NULL,
    [sortkey] [int] NOT NULL
    ) ON [PRIMARY]
