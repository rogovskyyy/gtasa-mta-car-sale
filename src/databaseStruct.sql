-- Drop table

-- DROP TABLE public.accounts

CREATE TABLE public.accounts (
	id serial NOT NULL,
	username varchar(32) NOT NULL,
	"password" varchar(64) NOT NULL,
	email varchar(100) NOT NULL,
	register_date varchar(19) NOT NULL,
	ip text NOT NULL,
	"key" varchar(39) NOT NULL,
	is_confirmed bool NOT NULL DEFAULT false,
	is_banned bool NOT NULL DEFAULT false,
	CONSTRAINT account_list_pkey1 PRIMARY KEY (id),
	CONSTRAINT accounts_un UNIQUE (username)
);

-- Drop table

-- DROP TABLE public.headlights

CREATE TABLE public.headlights (
	headlights varchar(60) NOT NULL,
	CONSTRAINT headlights_un UNIQUE (headlights)
);

-- Drop table

-- DROP TABLE public.images

CREATE TABLE public.images (
	images_id int4 NOT NULL,
	images_href text NOT NULL,
	CONSTRAINT images_notices_fk FOREIGN KEY (images_id) REFERENCES notices(id) ON UPDATE CASCADE
);

-- Drop table

-- DROP TABLE public.logs

CREATE TABLE public.logs (
	id serial NOT NULL,
	username varchar(32) NOT NULL,
	ip text NOT NULL,
	if_logged bool NOT NULL DEFAULT false,
	"date" varchar(100) NOT NULL,
	CONSTRAINT account_logs_pkey PRIMARY KEY (id),
	CONSTRAINT logs_accounts_fk FOREIGN KEY (username) REFERENCES accounts(username) ON UPDATE CASCADE
);

-- Drop table

-- DROP TABLE public.messages

CREATE TABLE public.messages (
	id serial NOT NULL,
	username varchar(32) NOT NULL,
	"to" varchar(32) NOT NULL,
	message text NULL,
	CONSTRAINT messages_pkey PRIMARY KEY (id),
	CONSTRAINT messages_accounts2_fk FOREIGN KEY ("to") REFERENCES accounts(username) ON UPDATE CASCADE,
	CONSTRAINT messages_accounts_fk FOREIGN KEY (username) REFERENCES accounts(username) ON UPDATE CASCADE
);

-- Drop table

-- DROP TABLE public.notices

CREATE TABLE public.notices (
	id serial NOT NULL,
	username varchar(32) NOT NULL,
	"date" varchar(19) NOT NULL,
	model varchar(60) NOT NULL,
	price int4 NOT NULL,
	course int4 NOT NULL,
	headlights varchar(60) NOT NULL,
	wheels varchar(60) NOT NULL,
	mk1 bool NOT NULL DEFAULT false,
	mk2 bool NOT NULL DEFAULT false,
	mk3 bool NOT NULL DEFAULT false,
	rh1 bool NOT NULL DEFAULT false,
	taxi bool NOT NULL DEFAULT false,
	CONSTRAINT notices_backup_pkey PRIMARY KEY (id),
	CONSTRAINT notices_accounts_fk FOREIGN KEY (username) REFERENCES accounts(username) ON UPDATE CASCADE,
	CONSTRAINT notices_headlights_fk FOREIGN KEY (headlights) REFERENCES headlights(headlights) ON UPDATE CASCADE,
	CONSTRAINT notices_vehicles_fk FOREIGN KEY (model) REFERENCES vehicles(model) ON UPDATE CASCADE,
	CONSTRAINT notices_wheels_fk FOREIGN KEY (wheels) REFERENCES wheels(wheels) ON UPDATE CASCADE
);

-- Drop table

-- DROP TABLE public.vehicles

CREATE TABLE public.vehicles (
	model varchar(60) NOT NULL,
	CONSTRAINT vehicles_pk PRIMARY KEY (model)
);

-- Drop table

-- DROP TABLE public.wheels

CREATE TABLE public.wheels (
	wheels varchar(60) NOT NULL,
	CONSTRAINT wheels_pkey PRIMARY KEY (wheels)
);
