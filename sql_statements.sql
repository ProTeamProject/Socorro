/* Account Table */

/* Specialist Table */
INSERT INTO Specialist (Account_ID, Specialist_Name, Average_Time, Number_Solved, Busy) VALUES
('2452', 'Janet', '5.2', '23', 'False'),
('2453', 'Bossman', '2.3', '42', 'True'),
('2454', 'Brad', '0.8', '8', 'True'),
('2455', 'Donald', '4.2', '64', 'False'),
('2456', 'Aaron', '6.7', '52', 'True'),
('2457', 'Edna', '2.3', '12', 'False');

/* Problem Type Table */
INSERT INTO Problem Type (Problem_Type_Name, Specialist_ID, Counter) VALUES
('Networking', '2457', 42),
('Security', '2455', '21'),
('Email', '2453', '12'),
('Word Processing', '2456', '32'),
('Printing', '2454', '52');

/* Operator Table */
INSERT INTO Operator_Table (Account_ID, Operator_ID, Operator_Name, Number_Calls) VALUES
('2312','12','Alice Smith','4'),
('2315','13','Olly Pethick','7'),
('2319','15','Josh Hope','9'),
('2321','72','Harrison Curtis','3');

/* Problem Table */
INSERT INTO Problem_Table
(Operator_ID, Specialist_ID, Caller_ID, Close_Date) VALUES
('12', '2452', '3543', '13/10/17'),
('13', '2453', '6534', '15/10/17'),
('72', '2452', '1232', '16/11/17'),
('15', '2455', '123', '15/02/12'),
('12', '2456', '987', '27/04/16'),
('13', '2457', '9876', '01/12/17');

/* Software Table */
INSERT INTO Software_Table (Software_License_Number, Problem_ID, Software_Name, Operating_System, Affected_Hardware) VALUES
('2738918ff2873646 ','4','Microsoft Word','Windows 10','Computer'),
('48857845asdgA4','3','Microsoft Outlook','Macintosh','Laptop'),
('aff141fda511','3','Microsoft Outlook','Linux','Computer '),
('gijsgpaj142dna','3','Microsoft Outlook','Macintosh','Laptop'),
('dagjkndaogndao12','4','Microsoft Word','Windows 10','Laptop'),
('ignrierfbis21ngona','4','Microsoft Word','Windows 10','Computer');

/* Caller/Employee Table */
INSERT INTO Caller_Employee_Table
(Caller_ID, Caller_Name, Job, Department, Extension) VALUES
('3543', 'Alex Jones', 'Customer Assitant', 'Customer_Services', '012')
('6534', 'Ranaplh', 'Manager', 'Logistics', '013')
('1232', 'Rishi', 'Clerk', 'Human_Resources', '014')
('123', 'Punjab', 'Accountant', 'Finance', '015')
('987', 'Posco', 'Foreman', 'Logistics', '013')
('9876', 'xiaohu', 'Operator', 'Customer_Service', '016')

/* Problem Status Table */

/* Equipment Table */
