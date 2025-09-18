# Hệ thống quản lý câu lạc bộ

admins:

- id int primary key
- fullname
- username varchar 200
- password varchar 255
- email varchar 100
- club_id int -> groups
- created_at timestamp DEFAULT CURRENT_TIMESTAMP
- updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

```sql
create table `users`(
  `id` int not null primary key auto_increment,
  `fullname` varchar(200) not null,
  `username` varchar(200) not null unique,
  `email` varchar(100) not null unique,
  `password` varchar(255) not null,
  `club_id` int not null,
  `created_at` timestamp not null default CURRENT_TIMESTAMP,
  `updated_at` timestamp  not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  constraint `fk_user_group`
    foreign key (`club_id`)
    references `clubs`(`id`)
);
```

clubs:

- id int primary key
- name varchar 100
- created_at timestamp DEFAULT CURRENT_TIMESTAMP
- updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

```sql
create table `clubs` (
  `id` int not null primary key auto_increment,
  `name` varchar(100) not null,
  `created_at` timestamp not null default CURRENT_TIMESTAMP,
  `updated_at` timestamp  not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

members:

```sql
create table `members` (
  `id` int not null primary key auto_increment,
  `name` varchar(100) not null,
  `mssv` varchar(10) not null unique,
  `email` varchar(100) unique,
  `class` varchar(20) not null,
  `created_at` timestamp not null default CURRENT_TIMESTAMP,
  `updated_at` timestamp  not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```