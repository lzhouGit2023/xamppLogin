/*create table Part(
 
partNo int primary key,
partName varchar(25),
partDescription varchar(50),
currentPrice int

);

create table Inventory(

partNo int primary key,
foreign key(partNo) references Part(partNo),
qtyOnHand int

);

create table Client(

clientId int primary key,
clientName varchar(25),
clientCity varchar(25),
clientPassword varchar(25),
moneyOwed int

);

create table POrder(

poNo int primary key,
clientId int,
DATETIME dateTime,
status varchar(25),
foreign key(clientId) references Client(clientId)

);
/*primary key*/
/*primary key*/

/*Orderline table updated*/
/*
create table Orderline(

lineNo int,
poNo int ,
partNo int,
qty int,
priceOrdered int,
foreign key(poNo) references POrder(poNo),
foreign key(partNo) references Part(partNo),
primary key(lineNo,poNo)
);
*/

/*select * from inventory
select * from orderline//(change column priceOrdered)
select * from porder
select * from client
select * from part
*/

/*Select qtyOnHand from inventory where partNo = 2
sample inserts:

insert into client values(1,'cli1','city1','pass1',0);
insert into client values(2,'cli2','city2','pass2',0);
insert into client values(3,'cli3','city3','pass3',0);
insert into client values(4,'cli4','city4','pass4',0);
insert into client values(5,'cli5','city5','pass5',0);

insert into part values (1,'part1','desc1',20);
insert into part values (2,'part2','desc2',15);
insert into part values (3,'part3','desc3',18);
insert into part values (4,'part4','desc4',20);
insert into part values (5,'part5','desc5',24);
insert into part values (6,'part6','desc6',22);

insert into inventory values (1,25);
insert into inventory values (2,30);
insert into inventory values (3,28);
insert into inventory values (4,30);
insert into inventory values (5,25);
insert into inventory values (6,18);

delete from orderline where lineNo between 1 and 100;
delete from porder where poNo between 1 and 100;
delete from inventory where partNo between 1 and 100;
delete from client where clientId between 1 and 100;
delete from part where partNo between 1 and 100;
*/