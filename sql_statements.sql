/* Account Table: Joshua Hope*/
INSERT INTO Account_Table (Account_ID, Name, Username, Password,Job Type)
VALUES ('2312',	'Alice',	'aliceSmith',	'K2p98h23',	'Operator'),
('2313',	'Janet',	'janetRodgers',	'j4V92391',	'Specailist'),
('2314',	'Bossman',	'mrBossman',	'5tS99a82',	'Specailist'),
('2315',	'Olly', 'ollyPethick',	'cW18305P',	'Operator'),
('2316',	'Brad',	'bradReeder',	'321W9rT1',	'specailist'),
('2317',	'Donald	donaldTrump',	'w93P44G7',	'specailist'),
('2318',	'Aaron',	'aaronHomes',	'bS4535h9',	'specailist'),
('2319',	'Joshua'	,'joshuaHope',	'39l5IJ90',	'Operator'),
('2320'	,'Edna',	'ednaMode',	'tQ52224c',	'specailist'),
('2321',	'Harrison',	'harrisonCurtis',	'0b67P9g1',	'operator')

/* Specialist Table: Harrison Curtis */
INSERT INTO Specialist_Table
(Account_ID, Average_Time, Problems_Assigned, Busy)
VALUES
('2313', '5.2', '23', '3', 'FALSE'),
('2314', '2.3', '42', '2', 'TRUE'),
('2316', '0.8', '8', '5', 'TRUE'),
('2317', '4.2', '64', '8', 'FALSE'),
('2318', '6.7', '52', '12', 'TRUE'),
('2320', '2.3', '12', '2'. 'FALSE'),

/* Problem Table: Aaron Homes*/

INSERT INTO Problem Table(Problem_ID, Account_ID, Account_ID, Caller_ID, Close_Date)
Values('1','12','2452','3543','13/10/17'),
      ('2','13','2453','6524','15/10/17'),
      ('3','72','2454','1232','16/11/17'),
      ('4','15','2455','123','15/02/12'),
      ('5','12','2456','987','27/04/16'),
      ('6','13','2457','9876','01/12/17');

/* Software Problem Table: Brad Reeder*/
INSERT INTO Software_Problem Table (Problem_ID, Software_License_Number, Operating_System, Affected_Hardware)
Values('1', '2738918ff2873646','Windows 10','Computer'),
	  ('2','48857845asdgA4','Macintosh','Laptop'),
	  ('3','aff141fda511','Linux','Computer'),
	  ('4','gijsgpaj142dna','Macintosh','Laptop'),
	  ('5','dagjkndaogndao12','Windows 10','Laptop'),
	  ('5','ignrierfbis21ngona','Windows 10','Computer')
/* Status Table: Harry Salmon*/

/* Specialises In Table: Joshua Hope*/
INSERT INTO Specailist_In (Problem_Type_ID, Account_ID)
VALUES('1','12'),
('2',	'13'),
('3',	'72'),
('4',	'15'),
('5',	'12')

/* Problem Status Table: Harrison Curtis */
INSERT INTO Status_Table
(Status_ID, Status_Type)
VALUES
('134', 'call'),
('135', 'open'),
('136', 'close'),
('137', 'assign'),
('138', 'note'),

/* Equipment Register Table: Aaron Homes*/

INSERT INTO Equipment Register Table(Equipment_Name, Equipment_Make, Equipment_Type)
Values('Dell GTX 12','Dell','Computer'),
      ('Macbook Pro','Apple','Laptop'),
      ('Sony Mouse','Sony','Peripheral'),
      ('Epson 23x43','Epson','Peripheral'),
      ('Acer Predator','Acer','Laptop');

/* Problem Counter Table: Brad Reeder*/
INSERT INTO Problem Counter TABLE (Problem_Type_ID, Occurences)
VALUES ('1','142')
	   ('2','124')
	   ('3','152')
	   ('4','612')
	   ('5','532')

/* Problem Type Table: Harry Salmon*/

/* Operator Table: Joshua Hope*/
INSERT INTO Operator_Table
VALUES ('2312',	'4'),
('2315',	'7'),
('2319',	'9'),
('2321',	'3')


/* Software Table: Harrison Curtis*/
INSERT INTO Software_Table
(Software_License_Number, Software_Name)
VALUES
('2738918ff2873646', 'Microsoft Word'),
('48857845asdgA4', ' Microsoft Outlook'),
('aff141fda511','Microsoft Outook'),
('gijsgpaj142dna','Microsoft Outook'),
('dagjkndaogndao12','Microsoft Outook'),
('ignrierfbis21ngona','Microsoft Outook'),

/* Employee Table: Aaron Homes */

INSERT INTO Employee Table(Caller_ID, Caller_Name, Job, Department, Extension)
Values('3543','Alex Jones','Customer Assistant','Customer Services','12'),
      ('6534','Ranalph','Manager','Logistics','12'),
      ('1232','Rishi','Clerk','Human Resources','12'),
      ('123','Punjab','Accountant','Finance','12'),
      ('987','Posco','Foreman','Logistics','12');

/* Equipment Table: Brad Reeder*/
INSERT INTO Equipment Table (Equipment_Serial_Number, Equipment_Name)
VALUES ('47392837283628','Epson 23x43')
	   ('98390820dw33','Sony Mouse')
	   ('efcf83djj377383','Dell GTX 12')
	   ('178s8jn38892ndj','Fridge Freezer EX13')
	   ('efknrn84fn84hf','MacBook pro')

/* Equipment Problem Table: Harry Salmon*/
