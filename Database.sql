show databases;

create database Ticket_Booking;

drop database Ticket_Booking;

use Ticket_Booking;

show tables;

create table Passengers (
    P_id int primary key auto_increment,
    first_name varchar(20) not null,
    last_name varchar(20) not null,
    Phone_No decimal(10, 0) not null,
    unique (first_name, last_name, Phone_No)
);

create table Users (
    U_id int primary key auto_increment,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    phone_no decimal(10, 0) not null,
    username varchar(50) not null unique,
    password varchar(50) not null,
    email_id varchar(50) not null unique
);

create table Airport (
	a_id int primary key auto_increment,
    name varchar(50) not null,
    address varchar(100) not null,
    unique (name, address)
);

create table Employee (
	e_id int primary key auto_increment,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    phone_no decimal(10, 0) not null,
    email_id varchar(50) not null unique,
    address varchar(100) not null,
    position varchar(50) not null,
    level decimal(1, 0) not null
);

create table Flight (
    F_id int primary key auto_increment,
    src varchar(20) not null,
    des varchar(20) not null,
    depart_time time not null,
    arrive_time time not null,
    depart_date date not null,
    arrive_date date not null,
    airplane_name varchar(30) not null,
    noOfSeats int not null,
    amount decimal(7,2) not null
);

-- create table Seats (
--  S_no int not null,
--     flight_id int not null,
--     class char not null,
--     position varchar(6) not null,
--     primary key (S_no, flight_id),
--     foreign key (flight_id) references Flight(F_id)
-- );

create table Payment (
    P_id int primary key auto_increment,
    mode enum('credit card', 'debit card', 'netbanking', 'ewallets') not null,
    amount decimal(7,2) not null,
    user_id int not null,
    foreign key (user_id) references Users(U_id)
);

create table Ticket (
    T_id int primary key auto_increment,
    passenger_id int,
    flight_id int,
    -- seat_no int,
    payment_id int,
    foreign key (passenger_id) references Passengers(P_id),
    foreign key (flight_id) references Flight(F_id),
    foreign key (payment_id) references Payment(P_id),
    -- foreign key (seat_no, flight_id) references Seats(S_no, flight_id),
    unique (passenger_id, flight_id),
    -- unique (flight_id, seat_no),
    unique (flight_id, passenger_id, payment_id)
);



drop table Passengers;
drop table Users;
drop table Flight;
drop table Seats;
drop table Payment;
drop table Ticket;
drop table Employee;
drop table Airport;

select * from Flight;
select * from Seats;
select * from Users;
select * from Passengers;
select * from Payment;
select * from Ticket;
select * from Employee;
select * from Airport;

desc Flight;
desc Seats;
desc Users;
desc Passengers;
desc Payment;
desc Ticket;
desc Employee;
desc Airport;

insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'Banglore', '04:25:00', '06:40:00', '2020-11-27', '2020-11-27', 'Airbus A320neo', 160, 2199.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'Chennai', '02:00:00', '04:25:00', '2020-11-27', '2020-11-27', 'Airbus A320neo', 160, 2999.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'Hyderabad', '08:30:00', '10:25:00', '2020-11-27', '2020-11-27','Airbus A320neo',160,2749.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Jaipur', 'Ahmedabad', '13:15:00', '14:30:00', '2020-11-27', '2020-11-27', 'Airbus A320neo', 160, 1999.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Kochi', 'Ahmedabad', '15:55:00', '18:20:00', '2020-11-27', '2020-11-27', 'Airbus A320neo', 160, 2499.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Kolkata', 'Ahmedabad', '19:45:00', '22:10:00', '2020-11-27', '2020-11-27','Airbus A320neo', 160, 3299.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Lucknow', 'Ahmedabad', '23:35:00', '01:30:00', '2020-11-27', '2020-11-28', 'Airbus A320neo', 160, 3299.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Banglore','Ahmedabad', '07:00:00', '09:15:00', '2020-11-28', '2020-11-28', 'Airbus A320neo', 160, 2299.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Chennai', 'Ahmedabad', '05:00:00', '07:25:00', '2020-11-28', '2020-11-28', 'Airbus A320neo', 160, 2799.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Mumbai', 'Ahmedabad', '16:15:00', '17:30:00', '2020-11-28', '2020-11-28', 'Airbus A320neo', 160, 2799.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'New Delhi', '22:30:00', '00:05:00', '2020-11-28', '2020-11-29', 'Airbus A320neo',160,1999.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'Varanasi', '03:55:00', '05:45:00', '2020-11-29', '2020-11-29', 'Airbus A320neo', 160, 2649.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'Pondicherry', '01:00:00', '03:35:00', '2020-11-29', '2020-11-29', 'Airbus A320neo', 160, 1749.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'Jaipur', '05:25:00', '06:40:00', '2020-11-29', '2020-11-29', 'Airbus A320neo', 160, 2049.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'Kochi', '06:05:00', '08:30:00', '2020-11-29', '2020-11-29', 'Airbus A320neo', 160, 2399.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'Kolkata', '09:00:00', '11:20:00', '2020-11-29', '2020-11-29', 'Airbus A320neo', 160, 2849.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('New Delhi', 'Ahmedabad', '11:55:00', '13:30:00', '2020-11-29', '2020-11-29', 'Airbus A320neo', 160, 2599.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Ahmedabad', 'Lucknow', '13:45:00', '15:45:00', '2020-11-29', '2020-11-29', 'Airbus A320neo', 160, 2699.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Varanasi', 'Ahmedabad', '18:30:00', '20:20:00', '2020-11-29', '2020-11-29', 'Airbus A320neo', 160, 2999.00);
insert into Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) values ('Pondicherry', 'Ahmedabad', '22:30:00', '01:05:00', '2020-11-29', '2020-11-30', 'Airbus A320neo', 160, 1999.00);

insert into Users (first_name, last_name, phone_no, username, password, email_id) values ('admin', 'test', 1234567890,'adminTest', 'admin_password', 'felafel@airvana.com');
insert into Users (first_name, last_name, phone_no, username, password, email_id) values ('dhwanil', 'ditani', 1234567890,'dhwanil-ditani', 'password', 'ditanidhwanil@gmail.com');