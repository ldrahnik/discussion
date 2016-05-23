Install discussion
==========

`git clone https://github.com/ldrahnik/discussion.git`
`composer install`

Create database discussion, execute sql file /db/schema.sql and optionally data.sql, next create local fongig too:

```
deaw:
    connection:
        host: 127.0.0.1
        username: root
        password:
        database: discussion
        driver: mysql
```

And finally enjoy spamming comments