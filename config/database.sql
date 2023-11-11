CREATE TABLE IF NOT EXISTS categories (
            id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
            name varchar(255),
            alias varchar(255),
            created_at timestamp
            );
CREATE TABLE IF NOT EXISTS parents (
            id bigint PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
            parent_id bigint REFERENCES categories (id) ,
            childrens_id bigint REFERENCES categories (id),
            created_at timestamp 
            );