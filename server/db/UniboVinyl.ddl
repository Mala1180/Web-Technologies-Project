-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1              
-- * Generator date: Dec  4 2018              
-- * Generation date: Wed Nov 24 23:21:04 2021 
-- * LUN file: C:\Users\kelvi\Documents\Universita\Tecnologie Web\DB_ProgettoWeb.lun 
-- * Schema: ER_logico/1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database UniboVinyl;
use UniboVinyl;


-- Tables Section
-- _____________ 

create table shipper (
     idShipper int not null auto_increment,
     company varchar(25) not null,
     email varchar(50) not null,
     username varchar(16) not null,
     password varchar(150) not null,
     constraint IDShipper primary key (idShipper));

create table customer (
     idCustomer int not null auto_increment,
     name varchar(25) not null,
     surname varchar(25) not null,
     email varchar(50) not null,
     username varchar(16) not null,
     password varchar(150) not null,
     idCard int,
     constraint IDCustomer primary key (idCustomer));

create table creditCard (
     idCard int not null auto_increment,
     holder varchar(100) not null,
     cardNumber varchar(16) not null,
     circuit varchar(10) not null,
     expiryDate date not null,
     cvv varchar(10) not null,
     isDeleted tinyint not null,
     idCustomer int not null,
     constraint IDcreditCard primary key (idCard),
     constraint IDcreditCard_1 unique (cardNumber));

create table transaction (
     idTransaction int not null auto_increment,
     idOrder int not null,
     transactionDate date not null,
     idCard int not null,
     constraint IDtransaction primary key (idTransaction),
     constraint FKpayment_ID unique (idOrder));

create table album (
     idAlbum int not null auto_increment,
     name varchar(50) not null,
     description varchar(280) not null,
     idAuthor int not null,
     duration int not null,
     imgPath varchar(50) not null,
     constraint IDalbum_ID primary key (idAlbum),
     constraint IDalbum_1 unique (idAuthor, name));

create table album_genre (
     album int not null,
     genre varchar(20) not null,
     constraint IDalbum_genre primary key (genre, album));

create table genre (
     name varchar(20) not null,
     constraint IDgenre primary key (name));

create table author (
     idAuthor int not null auto_increment,
     artName varchar(50) not null,
     email varchar(50) not null,
     username varchar(16) not null,
     password varchar(150) not null,
     constraint IDauthor primary key (idAuthor));

create table song (
     idAlbum int not null,
     name varchar(50) not null,
     duration int not null,
     constraint IDsong primary key (idAlbum, name));

create table product (
     idProduct int not null auto_increment,
     quantity int not null,
     price decimal(4,2) not null,
     description varchar(280) not null,
     type tinyint not null,
     idAlbum int,
     constraint IDproduct primary key (idProduct));

create table orderDetail (
     idProduct int not null,
     idOrder int not null,
     quantity int not null,
     subprice decimal(4,2) not null,
     constraint IDorderDetail primary key (idOrder, idProduct));

create table customerOrder (
     idOrder int not null auto_increment,
     state tinyint not null,
     orderDate date not null,
     shippingDate date,
     deliveryDate date,
     idCustomer int not null,
     constraint IDorder_ID primary key (idOrder));

create table cartEntry (
     idCartEntry int not null auto_increment,
     idProduct int not null,
     idCustomer int not null,
     quantity int not null,
     constraint IDcartEntry primary key (idCartEntry));

create table notification (
     idNotification int not null auto_increment,
     subject varchar(50) not null,
     message varchar(280) not null,
     notificationDate date not null,
     isRead tinyint not null,
     isDeleted tinyint not null,
     idCustomer int not null,
     constraint IDnotification primary key (idNotification));

create table featuring (
     idAuthor int not null,
     idAlbum int not null,
     song varchar(50) not null,
     constraint IDfeaturing primary key (idAuthor, idAlbum, song));


-- Constraints Section
-- ___________________ 

alter table customer add constraint FKprefers
     foreign key (idCard)
     references creditCard (idCard);

alter table creditCard add constraint FKhas
     foreign key (idCustomer)
     references customer (idCustomer);

alter table transaction add constraint FKwith
     foreign key (idCard)
     references creditCard (idCard);

alter table transaction add constraint FKpayment_FK
     foreign key (idOrder)
     references customerOrder (idOrder);

-- Not implemented
-- alter table album add constraint IDalbum_CHK
--     check(exists(select * from song
--                  where song.idAlbum = idAlbum)); 

-- Not implemented
-- alter table album add constraint IDalbum_CHK
--     check(exists(select * from product
--                  where product.idAlbum = idAlbum)); 

-- Not implemented
-- alter table album add constraint IDalbum_CHK
--     check(exists(select * from album_genre
--                  where album_genre.album = idAlbum)); 

alter table album add constraint FKwrittenBy
     foreign key (idAuthor)
     references author (idAuthor);

alter table album_genre add constraint FKgenre
     foreign key (genre)
     references genre (name);

alter table album_genre add constraint FKalbum
     foreign key (album)
     references album (idAlbum);

alter table song add constraint FKplaylist
     foreign key (idAlbum)
     references album (idAlbum);

alter table product add constraint FKplays
     foreign key (idAlbum)
     references album (idAlbum);

alter table orderDetail add constraint FKdetail
     foreign key (idOrder)
     references customerOrder (idOrder);

alter table orderDetail add constraint FKof
     foreign key (idProduct)
     references product (idProduct);

-- Not implemented
-- alter table customerOrder add constraint IDorder_CHK
--     check(exists(select * from orderDetail
--                  where orderDetail.idOrder = idOrder)); 

-- Not implemented
-- alter table customerOrder add constraint IDorder_CHK
--     check(exists(select * from transaction
--                  where transaction.idOrder = idOrder)); 

alter table customerOrder add constraint FKorders
     foreign key (idCustomer)
     references customer (idCustomer);

alter table cartEntry add constraint FKfilledBy
     foreign key (idCustomer)
     references customer (idCustomer);

alter table cartEntry add constraint FKrelativeTo
     foreign key (idProduct)
     references product (idProduct);

alter table notification add constraint FKto
     foreign key (idCustomer)
     references customer (idCustomer);

alter table featuring add constraint FKsong
     foreign key (idAlbum, song)
     references song (idAlbum, name);

alter table featuring add constraint FKauthor
     foreign key (idAuthor)
     references author (idAuthor);


-- Index Section
-- _____________ 