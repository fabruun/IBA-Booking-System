drop database if exists test_iba;
create database test_iba;

use test_iba

drop table if exists rekvirents;
create table rekvirents(
    rekvirent varchar(255) not null,
    primary key (rekvirent)
);

drop table if exists users;
create table users(
    id int not null auto_increment,
    uid varchar(255) not null,
    name varchar(255) not null,
    email varchar(255) not null,
    email_verified_at date not null,
    password blob not null,
    unique(email),
    primary key (id),
    foreign key (uid) references  rekvirents(rekvirent)
);

drop table if exists classes;
create table classes(
    klassenavn varchar(255) not null,
    primary key(klassenavn),
    foreign key (klassenavn) references rekvirents(rekvirent)
);
