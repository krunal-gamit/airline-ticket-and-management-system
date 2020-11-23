create table Passengers (
    P_id int primary key auto_increment,
    first_name varchar(20) not null,
    last_name varchar(20) not null,
    Phone_No decimal(10, 0) not null,
    unique (first_name, last_name, Phone_No)
);

create table Users (
    U_id int primary key auto_increment,
    username varchar(50) not null unique,
    password varchar(50) not null,
    email_id varchar(50) not null unique
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