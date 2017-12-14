/* Account Table */

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

/* Specialist Table */

/* Problem Table */

/* Software Problem Table */

/* Status Table */

/* Specialises In Table joshua */
INSERT INTO Specailist_In (Problem_Type_ID, Account_ID)
VALUES('1','12'),
('2',	'13'),
('3',	'72'),
('4',	'15'),
('5',	'12')

/* Problem Status Table */

/* Equipment Register Table */

/* Problem Counter Table */

/* Problem Type Table */

/* Operator Table joshua */
INSERT INTO Operator_Table(Account_ID, Number_Calls)
VALUES ('2312',	'4'),
('2315',	'7'),
('2319',	'9'),
('2321',	'3')

/* Software Table */

/* Software Table */

/* Employee Table */

/* Equipment Table */

/* Equipment Problem Table */
