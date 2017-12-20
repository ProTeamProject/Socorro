/* Account Table: Joshua Hope*/
INSERT INTO Account (Name, Username, Password, Job_Type)
VALUES
('Alice',	'aliceSmith',	'K2p98h23',	'operator'),
('Janet',	'janetRodgers',	'j4V92391',	'specialist'),
('Bossman',	'mrBossman',	'5tS99a82',	'specialist'),
('Olly', 'ollyPethick',	'cW18305P',	'operator'),
('Brad',	'bradReeder',	'321W9rT1',	'specialist'),
('Donald',	'donaldTrump',	'w93P44G7',	'specialist'),
('Aaron',	'aaronHomes',	'bS4535h9',	'specialist'),
('Joshua'	,'joshuaHope',	'39l5IJ90',	'operator'),
('Edna',	'ednaMode',	'tQ52224c',	'specialist'),
('Harrison',	'harrisonCurtis',	'0b67P9g1',	'operator')

/* Specialist Table: Harrison Curtis */
INSERT INTO Specialist (Account_ID, Average_Time, Number_Solved, Problems_Assigned, Busy)
VALUES
('2', '5.2', '23', '3', '0'),
('3', '2.3', '42', '2', '1'),
('5', '0.8', '8', '5', '0'),
('6', '4.2', '64', '8', '0'),
('7', '6.7', '52', '12', '1'),
('9', '2.3', '12', '2', '0')

/* Problem Table: Aaron Homes*/
INSERT INTO Problem (Operator_Account_ID, Specialist_Account_ID, Caller_ID, Problem_Desc, Problem_Type_ID, State, Open_Date, Close_Date)
VALUES
('12','2452','3543', 'blah blah blah', '1', 'open', '2017-10-05 14:32:56', ''),
('13','2453','6524', 'blah blah blah', '2', 'closed' '2017-10-06 14:32:56', '2017-10-09 14:32:56'),
('72','2454','1232', 'blah blah blah', '1', 'open', '2017-10-07 14:32:56', ''),
('15','2455','123', 'blah blah blah', '4', 'open', '2017-10-08 14:32:56', ''),
('12','2456','987', 'blah blah blah', '1', 'pending', '2017-10-09 14:32:56', ''),
('13','2457','9876', 'blah blah blah', '5', 'open', '2017-10-10 14:32:56', '')

/* Software Problem Table: Brad Reeder*/
INSERT INTO Software_Problem (Problem_ID, Software_License_Number, Operating_System)
Values
('1', '2738918ff2873646','Windows 10'),
('2','48857845asdgA4','Macintosh'),
('3','aff141fda511','Linux'),
('4','gijsgpaj142dna','Macintosh'),
('5','dagjkndaogndao12','Windows 10'),
('5','ignrierfbis21ngona','Windows 10')

/* Status Table: Harry Salmon*/
INSERT INTO Status (Status_ID, Status_Type)
VALUES ('1', 'call'),
('2', 'open'),
('3', 'close'),
('4', 'assign'),
('5', 'note')

/* Problem_Type_Specialist Table: Joshua Hope*/
INSERT INTO Problem_Type_Specialist (Problem_Type_ID, Account_ID)
VALUES('1','12'),
('2',	'13'),
('3',	'72'),
('4',	'15'),
('5',	'12')

/* Problem Status Table: Harrison Curtis - HS redone */
INSERT INTO Problem_Status (Problem_ID, Status_ID, Comment, Commenter, Status_Date)
VALUES
('1', '1', 'loss of connection', '2312', '2017-10-05 14:32:56'),
('2', '5', 'help needed formating', '2315', '2017-10-05 14:32:56'),
('3', '5', 'a virus has been detected', '2319', '2017-10-05 14:32:56'),
('4', '4', 'paper jam', '2321', '2017-10-05 14:32:56'),
('5', '5', 'emails not send', '2321', '2017-10-05 14:32:56'),
('6', '3', 'loss of email', '2312', '2017-10-05 14:32:56');

/* Operator Table Joshua */
INSERT INTO Operator (Account_ID, Number_Calls)
VALUES
('2312',	'4'),
('2315',	'7'),
('2319',	'9'),
('2321',	'3')

/* Equipment Register Table: Aaron Homes*/
INSERT INTO Equipment_Register (Equipment_Name, Equipment_Make, Equipment_Type)
VALUES
('Dell GTX 12','Dell','Computer'),
('Macbook Pro','Apple','Laptop'),
('Sony Mouse','Sony','Peripheral'),
('Epson 23x43','Epson','Peripheral'),
('Acer Predator','Acer','Laptop');

/* Problem Counter Table: Brad Reeder*/
INSERT INTO Problem_Counter (Problem_Type_ID, Occurences)
VALUES
('1','142')
('2','124')
('3','152')
('4','612')
('5','532')

/* Problem Type Table: Harry Salmon*/
INSERT INTO Problem_Type (Problem_Type_ID, Problem_Type_Name)
VALUES
('1', 'networking'),
('2', 'security'),
('3', 'email'),
('4', 'word processing'),
('5', 'printing');

/* Software Table: Harrison Curtis*/
INSERT INTO Software (Software_License_Number, Software_Name)
VALUES
('2738918ff2873646', 'Microsoft Word'),
('48857845asdgA4', ' Microsoft Outlook'),
('aff141fda511','Microsoft Outook'),
('gijsgpaj142dna','Microsoft Outook'),
('dagjkndaogndao12','Microsoft Outook'),
('ignrierfbis21ngona','Microsoft Outook'),

/* Employee Table: Aaron Homes */
INSERT INTO Employee (Caller_ID, Caller_Name, Job, Department, Extension)
VALUES
('3543','Alex Jones','Customer Assistant','Customer Services','12'),
('6534','Ranalph','Manager','Logistics','12'),
('1232','Rishi','Clerk','Human Resources','12'),
('123','Punjab','Accountant','Finance','12'),
('987','Posco','Foreman','Logistics','12');

/* Equipment Table: Brad Reeder*/
INSERT INTO Equipment (Equipment_Serial_Number, Equipment_Name)
VALUES
('47392837283628','Epson 23x43')
('98390820dw33','Sony Mouse')
('efcf83djj377383','Dell GTX 12')
('178s8jn38892ndj','Fridge Freezer EX13')
('efknrn84fn84hf','MacBook pro')

/* Equipment Problem Table: Harry Salmon*/
INSERT INTO Equipment_Problem (Problem_ID, Equipment_Serial_Number)
VALUES
('1', '47392837283628'),
('2', '98390820dw33'),
('3', 'efcf83djj377383'),
('4', '178s8jn38892ndj'),
('5', 'efknrn84fn84hf');

/* Solution Table: Olly Pethick*/
