drop table if exists admin;
create table admin
(
    pkid        bigint primary key not NULL auto_increment,
    id          varchar(20) not null unique,
    pass        varchar(20) not null,
    email       varchar(50) not null unique,
    status      int default 0,
    isAdministrator int default 0,
    isEditor        int default 0,
    isCareers int default 0,
    firstname   varchar(20) not null,
    lastname    varchar(20) not null,
    company     varchar(100),
    country     varchar(100),
    providence  varchar(100),
    city        varchar(100),
    postcode    varchar(50),
    phone       varchar(50),
    logindate   timestamp,
    regdate     timestamp default CURRENT_TIMESTAMP
);
 
insert into admin( id, pass, email, firstname, lastname, status, isAdministrator ) values ( 'manager', '1111', 'manager@purigenbiosystems.com', 'manager', 'manager', 1, 1 );

drop table if exists request_information;
create table request_information
(
    pkid                bigint primary key not NULL auto_increment,
    firstname           varchar(20) not null,
    lastname            varchar(20) not null,
    email               varchar(50) not null,
    phone               varchar(50) not null,
    organization		varchar(100),
    job_title			varchar(100),
    country             varchar(50),
    state               varchar(50),
    main_application	varchar(100),
    main_product		varchar(100),
    purchase_timeline	varchar(100),
    isreceive			int default 0,
    note				text,
    regdate             datetime DEFAULT CURRENT_TIMESTAMP
);


drop table if exists email_list;
create table email_list
(
    pkid                bigint primary key not NULL auto_increment,
    firstname           varchar(20) not null,
    lastname            varchar(20) not null,
    email               varchar(50) not null,
    regdate             timestamp default CURRENT_TIMESTAMP
);

drop table if exists media;
create table media
(
    pkid        bigint primary key not NULL auto_increment,
    year        varchar(4),
    month       varchar(2),
    day         varchar(2),
    source      varchar(100),
    url			varchar(500),
    maintitle   varchar(200) not null,
    subtitle    text,
    body        text,
    thumbnail   varchar(100),
    filename    varchar(100),
    orgfilename varchar(100),
    status      int default 0,
    regdate     timestamp default CURRENT_TIMESTAMP   
);

drop table if exists press;
create table press
(
    pkid        bigint primary key not NULL auto_increment,
    year        varchar(4),
    month       varchar(2),
    day         varchar(2),
    source      varchar(100),
    url			varchar(500),
    maintitle   varchar(200) not null,
    subtitle    text,
    body        text,
    thumbnail   varchar(100),
    filename    varchar(100),
    orgfilename varchar(100),
    status      int default 0,
    regdate     timestamp default CURRENT_TIMESTAMP   
);


drop table if exists events;
create table events
(
    pkid        bigint primary key not NULL auto_increment,
    type		int, /* 1:conference, 2:Seminar, 3:Meeting, 4:Workshop */
    startyear	int not null,
    startmonth  int NOT NULL,
    startday    int NOT NULL,
    endyear		int not null,
    endmonth    int NOT NULL,
    endday  	int NOT NULL,
    maintitle   varchar(200) NOT NULL,
        maintitle1  text,
        info_url    varchar(100),
        map_url     varchar(100),
        reg_url     varchar(100),
    subtitle    text,
    location1   varchar(500),
    location2   varchar(500),
    url			varchar(100),
    booth   	varchar(50),
    body    	text,
    thumbnail1  varchar(100),
    thumbnail2  varchar(100),
    filename    varchar(100),
    orgfilename    varchar(100),
    status      int default 0,
    updatedate  timestamp,
    regdate     timestamp default CURRENT_TIMESTAMP
);

drop table if exists video;
create table video
(
    pkid        bigint primary key not NULL auto_increment,
    year        varchar(4),
    month       varchar(2),
    day         varchar(2),
    title   	varchar(200) not null,
    body    	text,
    status      int default 0,
    videourl         varchar(500),
    thumbnail1   varchar(100),
    thumbnail2   varchar(100),
    filename    varchar(100),
    orgfilename    varchar(100),
    updatedate  timestamp,
    regdate     timestamp default CURRENT_TIMESTAMP
);

drop table if exists sheets;
create table sheets
(
    pkid        bigint primary key not NULL auto_increment,
    year        varchar(4),
    month       varchar(2),
    day         varchar(2),
    title   	varchar(200) not null,
    body    	text,
    status      int default 0,
    thumbnail1   varchar(100),
    thumbnail2   varchar(100),
    filename    varchar(100),
    orgfilename    varchar(100),
    updatedate  timestamp,
    regdate     timestamp default CURRENT_TIMESTAMP
);

drop table if exists literature;
create table literature
(
    pkid        bigint primary key not NULL auto_increment,
    type		int default 0,	
    year        varchar(4),
    month       varchar(2),
    day         varchar(2),
    title   	varchar(200) not null,
    body    	text,
    status      int default 0,
    thumbnail1   varchar(100),
    thumbnail2   varchar(100),
    filename    varchar(100),
    orgfilename    varchar(100),
    updatedate  timestamp,
    regdate     timestamp default CURRENT_TIMESTAMP
);

drop table if exists document;
create table document
(
    pkid        bigint primary key not NULL auto_increment,
    type		int default 0,	
    year        varchar(4),
    month       varchar(2),
    day         varchar(2),
    title   	varchar(200) not null,
    body    	text,
    status      int default 0,
    thumbnail1   varchar(100),
    thumbnail2   varchar(100),
    filename    varchar(100),
    orgfilename    varchar(100),
    updatedate  timestamp,
    regdate     timestamp default CURRENT_TIMESTAMP
);
