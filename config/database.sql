TRUNCATE TABLE categories, parents;
CREATE TABLE IF NOT EXISTS categories (
            id integer PRIMARY KEY,
            name varchar(255),
            alias varchar(255),
            created_at timestamp
            );
CREATE TABLE IF NOT EXISTS parents (
            id integer PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
            parent_id integer REFERENCES categories (id) ,
            childrens_id integer REFERENCES categories (id),
            created_at timestamp 
            );