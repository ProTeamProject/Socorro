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

/* Problem Table: Aaron Homes*/

INSERT INTO Problem Table(Problem_ID, Account_ID, Account_ID, Caller_ID, Close_Date)
Values('1','12','2452','3543','13/10/17'),
      ('2','13','2453','6524','15/10/17'),
      ('3','72','2454','1232','16/11/17'),
      ('4','15','2455','123','15/02/12'),
      ('5','12','2456','987','27/04/16'),
      ('6','13','2457','9876','01/12/17');

/* Software Problem Table: Brad Reeder*/

/* Status Table: Harry Salmon*/

/* Specialises In Table: Joshua Hope*/
INSERT INTO Specailist_In (Problem_Type_ID, Account_ID)
VALUES('1','12'),
('2',	'13'),
('3',	'72'),
('4',	'15'),
('5',	'12')

/* Problem Status Table: Harrison Curtis */

/* Equipment Register Table: Aaron Homes*/

INSERT INTO Equipment Register Table(Equipment_Name, Equipment_Make, Equipment_Type)
Values('Dell GTX 12','Dell','Computer'),
      ('Macbook Pro','Apple','Laptop'),
      ('Sony Mouse','Sony','Peripheral'),
      ('Epson 23x43','Epson','Peripheral'),
      ('Acer Predator','Acer','Laptop');

/* Problem Counter Table: Brad Reeder*/

/* Problem Type Table: Harry Salmon*/

/* Operator Table: Joshua Hope*/
INSERT INTO Operator_Table
VALUES ('2312',	'4'),
('2315',	'7'),
('2319',	'9'),
('2321',	'3')


/* Software Table: Harrison Curtis*/

/* Employee Table: Aaron Homes */

INSERT INTO Employee Table(Caller_ID, Caller_Name, Job, Department, Extension)
Values('3543','Alex Jones','Customer Assistant','Customer Services','12'),
      ('6534','Ranalph','Manager','Logistics','12'),
      ('1232','Rishi','Clerk','Human Resources','12'),
      ('123','Punjab','Accountant','Finance','12'),
      ('987','Posco','Foreman','Logistics','12');

/* Equipment Table: Brad Reeder*/

/* Equipment Problem Table: Harry Salmon*/
